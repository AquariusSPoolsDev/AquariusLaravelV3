<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\Concerns\ShowsAllPages;
use Tests\TestCase;

/**
 * Decorative effects that made the site look generated stay out: no aurora backgrounds, no mesh
 * gradients or dot patterns, no gradient buttons, and fade-in on scroll only on cards and photos.
 */
class DecorativeEffectsTest extends TestCase
{
    use DatabaseTransactions;
    use ShowsAllPages;

    /**
     * @return array<string, array{string}>
     */
    public static function pages(): array
    {
        return [
            'homepage' => ['/en'],
            'concrete pools' => ['/en/concrete-pools'],
            'fibreglass pools' => ['/en/fibreglass-pools'],
            'faq' => ['/en/faq'],
        ];
    }

    #[DataProvider('pages')]
    public function test_pages_have_no_aurora_mesh_or_dot_backgrounds(string $path): void
    {
        $this->get($path)->assertOk()
            ->assertDontSee('cta-aurora-bg', false)
            ->assertDontSee('header-dot-background', false)
            ->assertDontSee('radial-gradient(', false);
    }

    #[DataProvider('pages')]
    public function test_headings_and_labels_do_not_fade_in(string $path): void
    {
        $html = $this->get($path)->assertOk()->getContent();

        $this->assertDoesNotMatchRegularExpression('/<h[1-3][^>]*data-animate/', $html);
        $this->assertStringNotContainsString('class="pill-text', $html);
    }

    public function test_homepage_cards_still_fade_in_but_the_contact_form_does_not(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertMatchesRegularExpression('/class="aquarius-homepage-pool-card group\/card" data-animate/', $html);
        $this->assertMatchesRegularExpression('/class="aquarius-homepage-service-card group\/card" data-animate/', $html);
        $this->assertDoesNotMatchRegularExpression('/aquarius-contact-col-(left|right)[^>]*data-animate/', $html);
    }

    /**
     * @return array<string, array{string, string}>
     */
    public static function poolPages(): array
    {
        return [
            'concrete' => ['/en/concrete-pools', 'concrete'],
            'vinyl' => ['/en/vinyl-pools', 'vinyl'],
            'fibreglass' => ['/en/fibreglass-pools', 'fibreglass'],
        ];
    }

    #[DataProvider('poolPages')]
    public function test_pool_page_photos_open_in_the_lightbox(string $path, string $pool): void
    {
        $html = $this->get($path)->assertOk()->getContent();

        $this->assertStringContainsString('data-fslightbox="'.$pool.'-pools"', $html);
        if (glob(public_path("assets/images/{$pool}/steps/*.jpg")) !== []) {
            $this->assertStringContainsString('data-fslightbox="'.$pool.'-steps"', $html);
        }
        $this->assertStringNotContainsString('active:scale-105', $html);
    }

    public function test_homepage_showroom_photos_link_to_the_contact_showroom(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertSame(4, preg_match_all('#<a\s+href="'.preg_quote(url('/en/contact-us'), '#').'\#showpool"\s+class="group/img block#', $html));
        $this->assertDoesNotMatchRegularExpression('/group\/img[^"]*cursor-pointer/', $html);
    }

    public function test_whatsapp_button_and_scroll_bar_use_solid_colours(): void
    {
        $this->get('/en')->assertOk()
            ->assertDontSee('from-green-400', false)
            ->assertDontSee('from-secondary-300 via-secondary', false)
            ->assertSee('bg-green-700', false);
    }
}
