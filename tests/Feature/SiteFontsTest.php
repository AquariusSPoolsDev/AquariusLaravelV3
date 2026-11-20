<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * The public site uses two fonts from Bunny Fonts: Outfit for headings and Figtree for body text.
 * Playfair Display and Lato are gone, and error pages load the same fonts as the rest of the site.
 * Only the big titles (hero, page titles) are uppercase; section headings use normal case.
 */
class SiteFontsTest extends TestCase
{
    use DatabaseTransactions;

    private const FONTS_URL = 'https://fonts.bunny.net/css?family=figtree:400,500,600,700,800|outfit:400,500,600,700,800';

    public function test_pages_load_figtree_and_outfit_only(): void
    {
        SitePage::ContactUs->setVisible(true);

        foreach (['/en', '/en/contact-us'] as $path) {
            $this->get($path)->assertOk()
                ->assertSee(self::FONTS_URL, false)
                ->assertDontSee('playfair', false)
                ->assertDontSee('family=lato', false)
                ->assertDontSee('font-serif', false);
        }
    }

    public function test_section_headings_are_not_forced_to_uppercase(): void
    {
        SitePage::ContactUs->setVisible(true);
        SitePage::OurPools->setVisible(true);

        foreach (['/en/contact-us', '/en/our-pools', '/en/privacy', '/en/terms'] as $path) {
            $this->get($path)->assertOk()
                ->assertSee('class="aquarius-subheading', false)
                ->assertDontSee('class="aquarius-subheading uppercase"', false)
                ->assertDontSee('class="aquarius-subheading mt-8 uppercase"', false);
        }
    }

    public function test_page_text_starts_at_16px_on_every_screen(): void
    {
        SitePage::ContactUs->setVisible(true);
        SitePage::Faq->setVisible(true);
        SitePage::ConcretePools->setVisible(true);

        foreach (['/en', '/en/contact-us', '/en/faq', '/en/concrete-pools', '/ms/contact-us'] as $path) {
            $this->get($path)->assertOk()
                ->assertSee('<main class="mt-20 lg:mt-23.25">', false)
                ->assertDontSee('text-sm', false);
        }
    }

    public function test_big_headings_use_the_fluid_sizes(): void
    {
        $this->get('/en')->assertOk()
            ->assertSee('<h2 class="text-section font-semibold text-balance text-primary-900">', false)
            ->assertDontSee('lg:text-5xl', false)
            ->assertDontSee('lg:text-6xl', false);
    }

    public function test_error_pages_load_the_same_fonts_from_bunny(): void
    {
        $this->get('/en/this-page-does-not-exist')->assertNotFound()
            ->assertSee(self::FONTS_URL, false)
            ->assertDontSee('fonts.googleapis.com', false);
    }
}
