<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Read-only tests — phpunit.xml points at the development MySQL database,
 * so these must never use RefreshDatabase or write records.
 */
class LocalePrefixRoutingTest extends TestCase
{
    public function test_unmatched_url_returns_404_with_english_links(): void
    {
        $this->get('/does-not-exist')
            ->assertNotFound()
            ->assertSee('href="'.url('/en').'"', false);
    }

    public function test_unmatched_url_under_malay_prefix_returns_404_with_malay_links(): void
    {
        $this->get('/ms/does-not-exist')
            ->assertNotFound()
            ->assertSee('href="'.url('/ms').'"', false)
            ->assertSee('href="'.url('/ms/contact-us').'"', false);
    }

    public function test_throttled_contact_form_returns_429_error_page(): void
    {
        // Honeypot field short-circuits before validation, so nothing is written to the database.
        // The route allows 5 attempts per hour; the 6th is throttled.
        for ($attempt = 1; $attempt <= 5; $attempt++) {
            $this->post('/send-email', ['website' => 'bot'])->assertRedirect(route('thank-you'));
        }

        // Drop the {locale} URL default left over from the first request — in production each request
        // starts fresh, and ThrottleRequests runs before LocalizationMiddleware sets it
        URL::defaults(['locale' => null]);

        $this->post('/send-email', ['website' => 'bot'])
            ->assertTooManyRequests()
            ->assertSee('href="'.url('/en').'"', false);
    }

    public function test_error_page_renders_without_locale_url_default(): void
    {
        $this->view('errors.419')
            ->assertSee('419')
            ->assertSee('href="'.url('/en/contact-us').'"', false);
    }

    public function test_root_redirect_keeps_query_string(): void
    {
        $this->get('/?utm_source=google&utm_medium=cpc')
            ->assertMovedPermanently()
            ->assertRedirect('/en?utm_medium=cpc&utm_source=google');
    }

    public function test_legacy_url_redirect_keeps_query_string(): void
    {
        $this->get('/reviews?page=2')
            ->assertMovedPermanently()
            ->assertRedirect('/en/reviews?page=2');

        $this->get('/showcase?search=bali&tags[]=Balinese')
            ->assertMovedPermanently()
            ->assertRedirect('/en/showcase?search=bali&tags%5B0%5D=Balinese');
    }

    public function test_legacy_url_redirect_without_query_string(): void
    {
        $this->get('/about-us')
            ->assertMovedPermanently()
            ->assertRedirect('/en/about-us');

        $this->get('/projects/some-project')
            ->assertMovedPermanently()
            ->assertRedirect('/en/projects/some-project');
    }

    public function test_reviews_page_ajax_url_uses_current_locale(): void
    {
        $this->get('/ms/reviews')
            ->assertOk()
            ->assertSee("axios.get('".url('/ms/reviews')."'", false);
    }

    public function test_promotions_page_ajax_url_uses_current_locale(): void
    {
        $this->get('/en/promotions')
            ->assertOk()
            ->assertSee("axios.get('".url('/en/promotions')."'", false);
    }

    public function test_prefixed_ajax_request_returns_json(): void
    {
        $this->getJson('/en/reviews?page=1', ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertJsonStructure(['html', 'pagination']);
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function originalSiteUrls(): array
    {
        return [
            'concrete pools' => ['/our-pools/concrete-pools', '/en/concrete-pools'],
            'vinyl pools' => ['/our-pools/vinyl-pools', '/en/vinyl-pools'],
            'fiberglass spelling' => ['/our-pools/fiberglass-pools', '/en/fibreglass-pools'],
            'gallery' => ['/pool-gallery', '/en/showcase'],
            'services' => ['/services', '/en/our-pool-services'],
            'our services' => ['/services/our-services', '/en/our-pool-services'],
            'pool items' => ['/services/pool-items', '/en/pool-items-equipments'],
            'contact' => ['/contact', '/en/contact-us'],
            'faq' => ['/contact/faq', '/en/faq'],
            'legal' => ['/legal', '/en/terms'],
            'terms' => ['/legal/terms-and-conditions', '/en/terms'],
            'privacy' => ['/legal/privacy-policy', '/en/privacy'],
            'old promotions script' => ['/promotions.php', '/en/promotions'],
            'trailing slash' => ['/contact/', '/en/contact-us'],
        ];
    }

    #[DataProvider('originalSiteUrls')]
    public function test_original_site_urls_redirect_permanently_in_one_hop(string $oldPath, string $newPath): void
    {
        $this->get($oldPath)
            ->assertStatus(301)
            ->assertRedirect($newPath);

        $this->get($newPath)->assertOk();
    }

    public function test_original_site_redirect_keeps_query_string(): void
    {
        $this->get('/pool-gallery?utm_source=facebook')
            ->assertStatus(301)
            ->assertRedirect('/en/showcase?utm_source=facebook');
    }

    public function test_v2_subdomain_redirects_to_the_same_path_on_the_main_domain(): void
    {
        $this->get('http://v2.aquariusswimmingpools.com/')
            ->assertStatus(301)
            ->assertRedirect('https://aquariusswimmingpools.com/');

        $this->get('http://v2.aquariusswimmingpools.com/pool-gallery?utm_source=facebook')
            ->assertStatus(301)
            ->assertRedirect('https://aquariusswimmingpools.com/pool-gallery?utm_source=facebook');
    }

    public function test_main_domain_is_not_caught_by_the_v2_redirect(): void
    {
        $this->get('http://aquariusswimmingpools.com/en/faq')->assertOk();
    }

    public function test_old_pool_shop_link_goes_to_the_online_shop(): void
    {
        $this->get('/services/pool-shop')->assertRedirect('https://thesplashshop.com');
    }

    public function test_robots_txt_lets_google_index_pool_photos_only(): void
    {
        $robots = file_get_contents(public_path('robots.txt'));

        $this->assertStringContainsString('Disallow: /storage', $robots);
        $this->assertStringContainsString('Allow: /storage/image_gallery/', $robots);
        $this->assertStringContainsString('Allow: /storage/projects/', $robots);
        $this->assertStringNotContainsString('Allow: /storage/promotion_materials', $robots);
    }
}
