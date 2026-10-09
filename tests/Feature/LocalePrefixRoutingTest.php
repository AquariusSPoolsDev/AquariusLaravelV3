<?php

namespace Tests\Feature;

use Illuminate\Support\Facades\URL;
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
}
