<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * The public site uses two fonts from Bunny Fonts: Outfit for headings and Figtree for body text.
 * Playfair Display and Lato are gone, and error pages load the same fonts as the rest of the site.
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

    public function test_error_pages_load_the_same_fonts_from_bunny(): void
    {
        $this->get('/en/this-page-does-not-exist')->assertNotFound()
            ->assertSee(self::FONTS_URL, false)
            ->assertDontSee('fonts.googleapis.com', false);
    }
}
