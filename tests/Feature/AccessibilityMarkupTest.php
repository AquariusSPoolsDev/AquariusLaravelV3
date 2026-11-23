<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\MessageBag;
use Illuminate\Support\ViewErrorBag;
use Tests\Concerns\ShowsAllPages;
use Tests\TestCase;

/**
 * Accessibility fixes from the 2026-11-23 audit (axe-core + WCAG 2.2 AA): skip link, labelled and
 * autofill-ready form fields, logo names that match their text, translated cookie notice, real lists
 * and heading levels, and no screen-reader interruptions from static info boxes.
 */
class AccessibilityMarkupTest extends TestCase
{
    use DatabaseTransactions;
    use ShowsAllPages;

    public function test_every_page_has_a_skip_link_to_main_content(): void
    {
        foreach (['/en', '/en/concrete-pools', '/ms/faq'] as $path) {
            $html = $this->get($path)->assertOk()->getContent();

            $this->assertStringContainsString('<a href="#main-content" class="skip-link">', $html);
            $this->assertStringContainsString('<main id="main-content"', $html);
            $this->assertStringNotContainsString('{-- ', $html, 'A broken Blade comment is printing as page text');
        }

        $this->get('/ms')->assertSee('Langkau ke kandungan utama');
    }

    public function test_charset_comes_first_and_the_page_declares_its_colour_scheme(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();
        $head = substr($html, 0, 400);

        $this->assertStringContainsString('<meta charset="utf-8">', $head);
        $this->assertStringContainsString('<meta name="color-scheme" content="light">', $html);
        $this->assertStringContainsString('<meta name="theme-color"', $html);
        $this->assertStringContainsString('motion-safe:scroll-smooth', $html);
    }

    public function test_contact_form_fields_are_labelled_and_autofill_ready(): void
    {
        $html = $this->get('/en/contact-us')->assertOk()->getContent();

        $this->assertMatchesRegularExpression('/<select name="country_code" id="country_code" aria-label="Country code"/', $html);
        $this->assertStringContainsString('autocomplete="name"', $html);
        $this->assertStringContainsString('autocomplete="email"', $html);
        $this->assertStringContainsString('autocomplete="tel-national"', $html);
        $this->assertStringContainsString('autocomplete="tel-country-code"', $html);
        $this->assertStringContainsString('<span class="text-error-300" aria-hidden="true">*</span>', $html);
        $this->assertStringNotContainsString('aria-invalid="true"', $html);
    }

    public function test_a_field_with_an_error_points_to_its_message(): void
    {
        $errors = (new ViewErrorBag)->put('default', new MessageBag(['cust_email' => 'The email is invalid.']));

        $html = $this->withSession(['errors' => $errors])->get('/en/contact-us')->assertOk()->getContent();

        $this->assertMatchesRegularExpression('/id="cust_email"[^>]*aria-invalid="true" aria-describedby="cust_email-error"/s', $html);
        $this->assertStringContainsString('<p id="cust_email-error"', $html);
    }

    public function test_logo_links_are_named_by_their_visible_text(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertStringNotContainsString('aria-label="Aquarius Swimming Pools"', $html);
        $this->assertStringContainsString('<span class="name-1 ">Aquarius</span> <span class="name-2 ">Swimming Pools</span>', $html);
    }

    public function test_cookie_notice_is_a_translated_aside_not_a_dialog(): void
    {
        $html = $this->get('/ms')->assertOk()->getContent();

        $this->assertStringContainsString('aria-label="Notis kuki"', $html);
        $this->assertStringContainsString('Terima', $html);
        $this->assertStringNotContainsString('This website uses cookies', $html);
        $this->assertStringNotContainsString('role="dialog"', $html);
    }

    public function test_footer_uses_real_lists_and_does_not_skip_heading_levels(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertStringNotContainsString('role="listitem"', $html);
        $this->assertStringContainsString('<ul class="flex flex-wrap gap-x-1" aria-label="Social media">', $html);
        $this->assertStringContainsString('<h2 class="aquarius-footer-heading">', $html);
        $this->assertStringNotContainsString('<h4 class="aquarius-footer-heading">', $html);
    }

    public function test_static_info_boxes_do_not_interrupt_screen_readers(): void
    {
        $html = $this->get('/en/showcase')->assertOk()->getContent();

        $this->assertDoesNotMatchRegularExpression('/aquarius-alert[^"]*"[^>]*role="alert"/', $html);
        $this->assertStringContainsString('<h2 id="howtouse"', $html);
    }

    public function test_current_pool_card_keeps_full_contrast(): void
    {
        $html = $this->get('/en/vinyl-pools')->assertOk()->getContent();

        $this->assertStringContainsString('aria-current="page" data-current-pool', $html);
        $this->assertStringNotContainsString('opacity-50', $html);
        $this->assertStringNotContainsString('text-neutral-400">'.e(__('strings.explore_pools_current_page')), $html);
    }

    public function test_landmarks_are_named_and_the_pool_page_banner_sits_inside_main(): void
    {
        $html = $this->get('/en/pool-items-equipments')->assertOk()->getContent();
        $this->assertStringContainsString('aria-label="Main"', $html);
        $this->assertStringContainsString('aria-label="Equipment sections"', $html);

        $concrete = $this->get('/en/concrete-pools')->assertOk()->getContent();
        $this->assertLessThan(strpos($concrete, '</main>'), strpos($concrete, __('strings.concrete_pool_cta_title')));
    }

    public function test_images_do_not_repeat_their_alt_text_as_a_tooltip(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertDoesNotMatchRegularExpression('/<img[^>]*\stitle="/', $html);
    }
}
