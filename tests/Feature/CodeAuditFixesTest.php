<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use App\Models\CustReview;
use App\Models\Project;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Blade;
use Tests\Concerns\ShowsAllPages;
use Tests\TestCase;

/**
 * Items 1–5 of code-audit.md (2026-11-23): Tailwind source paths, the removed component classes,
 * review numbers that only count published reviews, cleaned rich text, and a root favicon.
 *
 * phpunit.xml points at the development MySQL database; every test runs in a rolled-back transaction.
 */
class CodeAuditFixesTest extends TestCase
{
    use DatabaseTransactions;
    use ShowsAllPages;

    public function test_tailwind_sources_stay_inside_the_project(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));

        $this->assertDoesNotMatchRegularExpression('/@source\s+"\.\.\/\.\.\/\.\.\//', $css);
        $this->assertStringContainsString('@source "../../**/*.blade.php";', $css);
    }

    public function test_components_render_the_same_on_every_operating_system(): void
    {
        // Class files only loaded on Windows (case-insensitive paths), so the live Linux server ran different code
        $this->assertDirectoryDoesNotExist(app_path('View/Components'));

        // The default that used to live in the class is now in the view's @props
        $html = Blade::render('<x-pool-services.pool-service-card :title="$title" :content="[\'Text\']" image="x.jpg" />', ['title' => 'Repair & Maintenance']);

        $this->assertStringNotContainsString('lg:flex-row-reverse', $html);
        $this->assertStringContainsString('alt="Repair &amp; Maintenance"', $html);
        $this->assertStringContainsString('>Repair &amp; Maintenance</h2>', $html);
    }

    public function test_service_titles_are_escaped_exactly_once(): void
    {
        $html = $this->get('/en/our-pool-services')->assertOk()->getContent();

        $this->assertStringNotContainsString('&amp;amp;', $html);
        $this->assertStringContainsString(e(__('strings.pool_service_item_2_title')), $html);
    }

    public function test_unpublished_reviews_do_not_change_the_public_numbers(): void
    {
        $before = CustReview::platformSummary();
        $homepageBefore = $this->get('/en')->assertOk()->getContent();

        CustReview::factory()->google(1)->unpublished()->create();
        CustReview::factory()->facebook()->unpublished()->create();

        $this->assertSame($before, CustReview::platformSummary());
        $this->assertSame($homepageBefore, $this->get('/en')->assertOk()->getContent());
    }

    public function test_homepage_and_reviews_page_show_the_same_published_numbers(): void
    {
        $before = CustReview::platformSummary();

        CustReview::factory()->google(5)->create();
        CustReview::factory()->facebook()->create();

        $after = CustReview::platformSummary();
        $this->assertSame($before['googleTotal'] + 1, $after['googleTotal']);
        $this->assertSame($before['facebookTotal'] + 1, $after['facebookTotal']);

        // The Google pill prints the average, then "Based on <strong>total</strong>": both pages must agree
        $googlePill = '/>'.preg_quote((string) $after['googleAverage'], '/')
            .'<\/span>.*?<strong class="[^"]*">'.$after['googleTotal'].'<\/strong>/s';

        $this->assertMatchesRegularExpression($googlePill, $this->get('/en')->assertOk()->getContent());
        $this->assertMatchesRegularExpression($googlePill, $this->get('/en/reviews')->assertOk()->getContent());
    }

    public function test_review_and_project_html_is_cleaned_before_it_is_shown(): void
    {
        $review = CustReview::factory()->create([
            'review' => '<p>Lovely <strong>pool</strong></p><script>alert("review")</script><img src="x" onerror="alert(1)">',
            'reviewed_at' => now()->addYear(),
        ]);

        $reviews = $this->get('/en/reviews')->assertOk()->getContent();
        $this->assertStringContainsString('Lovely <strong>pool</strong>', $reviews);
        $this->assertStringNotContainsString('alert("review")', $reviews);
        $this->assertStringNotContainsString('onerror', $reviews);

        $project = Project::query()->create([
            'title' => 'Audit Sanitize Pool',
            'description' => '<p>Built in 2020</p><script>alert("project")</script><a href="javascript:alert(2)">link</a>',
            'is_published' => true,
        ]);

        $page = $this->get('/en/projects/'.$project->slug)->assertOk()->getContent();
        $this->assertStringContainsString('<p>Built in 2020</p>', $page);
        $this->assertStringNotContainsString('alert("project")', $page);
        $this->assertStringNotContainsString('href="javascript:', $page);
        $this->assertNotNull($review->id);

        // The meta description gets plain text, not the editor's HTML tags
        $this->assertStringContainsString('<meta name="description" content="Built in 2020', $page);
        $this->assertStringNotContainsString('content="&lt;p&gt;', $page);
    }

    public function test_project_detail_pages_open_in_both_languages(): void
    {
        // The {locale} prefix used to arrive as the slug, so every project page was a 404
        $project = Project::query()->create(['title' => 'Audit Route Pool', 'is_published' => true]);

        $this->get('/en/projects/'.$project->slug)->assertOk()->assertSee('Audit Route Pool');
        $this->get('/ms/projects/'.$project->slug)->assertOk()->assertSee('Audit Route Pool');
        $this->get('/en/projects/no-such-project')->assertNotFound();
    }

    public function test_the_favicon_is_served_from_the_site_root(): void
    {
        $this->assertFileExists(public_path('favicon.ico'));
        $this->assertSame("\x00\x00\x01\x00", substr(file_get_contents(public_path('favicon.ico')), 0, 4));
    }

    public function test_every_page_uses_one_layout_without_inline_scripts(): void
    {
        // #6: one layout; the homepage simply has no photo header. Scroll effects live in app.js.
        $this->assertFileDoesNotExist(resource_path('views/layout/homepage.blade.php'));
        $this->assertStringContainsString("import './scroll-effects';", file_get_contents(resource_path('js/app.js')));

        $homepage = $this->get('/en')->assertOk()->getContent();
        $this->assertStringNotContainsString('class="aquarius-header"', $homepage);
        $this->assertStringContainsString('data-counter="1000"', $homepage);

        foreach (['/en', '/en/faq', '/ms/reviews', '/en/promotions'] as $path) {
            $html = $this->get($path)->assertOk()->getContent();
            $this->assertStringNotContainsString('new IntersectionObserver', $html, $path);
            $this->assertStringNotContainsString("document.addEventListener('DOMContentLoaded'", $html, $path);
        }

        $this->assertStringContainsString('class="aquarius-header"', $this->get('/en/faq')->getContent());
    }

    public function test_lists_page_through_one_shared_ajax_helper(): void
    {
        // #7: reviews, promotions and the gallery answer AJAX the same way and show translated loaders
        foreach (['/en/reviews', '/en/promotions', '/en/showcase'] as $path) {
            $this->getJson($path, ['X-Requested-With' => 'XMLHttpRequest'])->assertOk()->assertJsonStructure(['html', 'pagination']);
        }

        $reviews = $this->get('/ms/reviews')->assertOk()->getContent();
        $this->assertStringContainsString('<div id="reviews-loading" hidden', $reviews);
        $this->assertStringContainsString('Memuatkan ulasan...', $reviews);
        $this->assertStringNotContainsString('Loading reviews...', $reviews);

        $this->assertStringContainsString('<div id="no-results-message" hidden>', $this->get('/en/showcase')->getContent());
    }

    public function test_the_three_pool_pages_share_one_template(): void
    {
        // #8 and #17: one view, given the pool by the route
        foreach (['concrete' => 3, 'vinyl' => 3, 'fibreglass' => 2] as $pool => $photos) {
            $this->get('/en/'.$pool.'-pools')
                ->assertOk()
                ->assertViewIs('pages.pool-type')
                ->assertViewHas('pool', $pool)
                ->assertSee(__('strings.'.$pool.'_pool_body'))
                ->assertSee('photo '.$photos.' of '.$photos)
                ->assertDontSee('photo '.($photos + 1).' of');
        }

        $this->assertFileDoesNotExist(resource_path('views/pages/04-pool-type-vinyl.blade.php'));
        $this->get('/en/vinyl-pools')->assertSee('?interest=Steel+Structure+Vinyl+Pools', false);
    }

    public function test_structured_data_names_are_translated_and_plain_text(): void
    {
        // #19: breadcrumbs and service names follow the page language, and "&" reaches Google as "&"
        $schemas = function (string $path): array {
            preg_match_all('/<script type="application\/ld\+json">(.*?)<\/script>/s', $this->get($path)->assertOk()->getContent(), $matches);

            return collect($matches[1])->map(fn (string $json): array => json_decode($json, true, flags: JSON_THROW_ON_ERROR))->keyBy(fn (array $schema): string => implode(',', (array) ($schema['@type'] ?? '@graph')))->all();
        };

        $malay = $schemas('/ms/fibreglass-pools');
        $this->assertSame(__('strings.fibreglass_pool_title_heading', locale: 'ms_MY'), $malay['Service']['name']);
        $this->assertSame(
            [__('strings.navbar_homepage', locale: 'ms_MY'), __('strings.our_pools_display_heading', locale: 'ms_MY'), __('strings.fibreglass_pool_display_heading', locale: 'ms_MY')],
            array_column($malay['BreadcrumbList']['itemListElement'], 'name'),
        );

        $english = $schemas('/en/pool-items-equipments');
        $this->assertSame('Pool Items & Equipment', $english['BreadcrumbList']['itemListElement'][1]['name']);
        $this->assertSame(url('/en'), $english['BreadcrumbList']['itemListElement'][0]['item']);
    }

    public function test_pros_and_cons_skip_empty_points(): void
    {
        // #9: one card component; empty slots in the lang files don't print an empty bullet
        $html = Blade::render('<x-our-pools.pros-cons-card pool="vinyl" type="disadvantage" />');

        $this->assertSame(1, substr_count($html, '<li>'));
        $this->assertStringContainsString(e(__('strings.vinyl_pool_disadvantage_1_title')).':</strong>', $html);
        $this->assertSame(3, substr_count(Blade::render('<x-our-pools.pros-cons-card pool="concrete" type="advantage" />'), '<li>'));
    }

    public function test_html_sitemap_lists_projects_only_while_the_page_is_on(): void
    {
        $this->get('/en/sitemap')->assertOk()->assertSee('href="'.route('projects-page', ['locale' => 'en']).'"', false);

        SitePage::Projects->setVisible(false);

        $this->get('/en/sitemap')->assertOk()->assertDontSee('href="'.route('projects-page', ['locale' => 'en']).'"', false);
    }

    public function test_pagination_marks_the_current_page_clearly(): void
    {
        // Admin (Livewire) tests earlier in the run swap the paginator's view and resolvers; put Laravel's back
        Paginator::defaultView('pagination::tailwind');
        Paginator::currentPathResolver(fn (): string => request()->url());
        Paginator::currentPageResolver(fn (string $pageName = 'page'): int => (int) request()->input($pageName, 1));

        $html = $this->get('/en/reviews?page=2')->assertOk()->getContent();
        $this->assertMatchesRegularExpression('/<span aria-current="page">\s*<span class="([^"]*)">2<\/span>/', $html);
        preg_match('/<span aria-current="page">\s*<span class="([^"]*)">2<\/span>/', $html, $current);
        $this->assertContains('bg-primary-700', explode(' ', $current[1]));
        $this->assertContains('text-white', explode(' ', $current[1]));
        $this->assertStringNotContainsString('hover:text-neutral-500', $html);
    }

    public function test_view_only_routes_use_route_view(): void
    {
        $routes = file_get_contents(base_path('routes/web.php'));

        $this->assertDoesNotMatchRegularExpression("/function \(\) \{\s*return view\(/", $routes);
    }
}
