<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Small fixes before the public launch: translated error page buttons, gallery search feedback
 * and tidier styles. Emails and the admin link are in EmailSenderNamesTest
 * and ContactSubmissionReadStatusTest.
 */
class LaunchPrepFixesTest extends TestCase
{
    use DatabaseTransactions;

    public function test_error_page_buttons_follow_the_page_language(): void
    {
        $this->get('/ms/halaman-yang-tiada')->assertNotFound()
            ->assertSee('Kembali ke Laman Utama')
            ->assertSee('Hubungi Kami')
            ->assertDontSee('Back to Homepage');

        $this->get('/en/page-that-does-not-exist')->assertNotFound()
            ->assertSee('Back to Homepage')
            ->assertSee('Contact Us')
            ->assertDontSee('Kembali ke Laman Utama');
    }

    public function test_the_gallery_announces_results_and_has_an_error_message(): void
    {
        $html = $this->get('/ms/showcase')->assertOk()->getContent();

        $this->assertStringContainsString('<div id="gallery-error-message" hidden>', $html);
        $this->assertStringContainsString('Gambar tidak dapat dimuatkan.', $html);
        $this->assertMatchesRegularExpression('/<p id="gallery-search-status" class="sr-only" aria-live="polite" aria-atomic="true"/', $html);
        $this->assertStringContainsString('data-many=":count gambar dijumpai."', $html);

        // The visible "no results" box is no longer a second live region; the status line speaks for it.
        $this->assertStringNotContainsString('role="status">', explode('id="no-results-message"', $html)[1] ?? '');
    }

    public function test_gallery_search_answers_with_the_total_number_of_photos(): void
    {
        $this->getJson('/en/showcase?search=zzz-no-such-photo-zzz', ['X-Requested-With' => 'XMLHttpRequest'])
            ->assertOk()
            ->assertJsonStructure(['html', 'pagination', 'total'])
            ->assertJsonPath('total', 0);
    }

    public function test_styles_drop_the_long_menu_slide_and_the_duplicate_faq_rules(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));

        $this->assertStringNotContainsString('-1000px', $css);
        $this->assertStringNotContainsString('-webkit-animation', $css);
        $this->assertStringContainsString('@media (prefers-reduced-motion: reduce)', $css);
        $this->assertSame(1, substr_count($css, '.aquarius-accordion-toggle {'));
        $this->assertStringContainsString(".aquarius-accordion-group-faq,\n.faq-section {", str_replace("\r\n", "\n", $css));
    }
}
