<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use App\Models\CustReview;
use App\Models\Project;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Blade;
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

    protected function setUp(): void
    {
        parent::setUp();

        foreach (SitePage::cases() as $page) {
            $page->setVisible(true);
        }
    }

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
}
