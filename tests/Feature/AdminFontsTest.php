<?php

namespace Tests\Feature;

use Filament\Facades\Filament;
use Tests\TestCase;

/**
 * The admin uses the same fonts as the public site, from Bunny Fonts: Figtree for text and
 * Outfit for headings. Lato, Google Fonts and Filament's default Inter are no longer loaded.
 */
class AdminFontsTest extends TestCase
{
    public function test_the_admin_loads_figtree_and_outfit_from_bunny(): void
    {
        $this->get(Filament::getPanel('admin')->getLoginUrl())->assertOk()
            ->assertSee('https://fonts.bunny.net/css?family=figtree:400,500,600,700|outfit:400,500,600,700&display=swap', false)
            ->assertSee("--font-family: 'Figtree'", false)
            ->assertDontSee('fonts.googleapis.com', false)
            ->assertDontSee('Lato', false)
            ->assertDontSee('Inter Variable', false);
    }

    public function test_the_admin_theme_no_longer_sets_lato(): void
    {
        $theme = file_get_contents(resource_path('css/filament/admin/theme.css'));

        $this->assertStringNotContainsString('Lato', $theme);
        $this->assertStringNotContainsString('fonts.googleapis.com', $theme);
        $this->assertStringContainsString("'Outfit'", $theme);
    }
}
