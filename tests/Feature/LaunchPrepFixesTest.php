<?php

namespace Tests\Feature;

use App\Models\Promotion;
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

    public function test_the_page_header_photo_loads_first_not_lazily(): void
    {
        $html = $this->get('/en/faq')->assertOk()->getContent();

        $this->assertMatchesRegularExpression('/<img fetchpriority="high" decoding="async" class="aquarius-header-image"/', $html);
        $this->assertDoesNotMatchRegularExpression('/<img[^>]*loading="lazy"[^>]*class="aquarius-header-image"/', $html);
    }

    /**
     * Both sliders share one arrow style: 44px round white buttons set in from the photo edges,
     * with a hover state and a keyboard focus ring (were flat blue squares flush to the edges).
     */
    public function test_slider_arrows_are_round_and_shared_by_both_sliders(): void
    {
        $css = str_replace("\r\n", "\n", file_get_contents(resource_path('css/app.css')));

        $this->assertStringContainsString(".hero-mobile-swiper,\n.promo-swiper {\n    --swiper-navigation-size: 44px;\n    --swiper-navigation-sides-offset: 12px;", $css);
        $this->assertStringContainsString('@apply rounded-full bg-white/85 text-primary-700', $css);
        $this->assertStringContainsString('focus-visible:outline-primary-700', $css);
        $this->assertStringNotContainsString('@apply h-10 w-10 bg-primary active:bg-primary-800', $css);

        $this->get('/en')->assertOk()
            ->assertSee('<div class="swiper-button-prev"></div>', false)
            ->assertSee('<div class="swiper-button-next"></div>', false);
    }

    /**
     * White on secondary-500 was 3.4:1; near-black on secondary-400 is 7.2:1, like the main CTA button.
     */
    public function test_the_current_promotion_badge_has_readable_contrast(): void
    {
        $promotion = new Promotion([
            'title' => 'Badge contrast check',
            'description' => 'Test',
            'start_time' => now(),
        ]);

        $html = view('components.promotions.grid', ['promotions' => collect([$promotion])])->render();

        $this->assertStringContainsString('bg-secondary-400 text-neutral-950', $html);
        $this->assertStringNotContainsString('bg-secondary-500 text-white', $html);
    }
}
