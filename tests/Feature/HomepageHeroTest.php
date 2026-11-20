<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * The homepage hero must render readable and fast without JavaScript: visible headline and buttons,
 * an iPhone-friendly background video with a poster, and toggle labels in the visitor's language.
 */
class HomepageHeroTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        SitePage::Homepage->setVisible(true);
    }

    public function test_hero_heading_and_buttons_are_not_hidden_behind_scroll_animation(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertMatchesRegularExpression('/<h1 class="aquarius-main-heading">/', $html);
        $this->assertDoesNotMatchRegularExpression('/<h1[^>]*data-animate/', $html);
        $this->assertMatchesRegularExpression('/<div class="aquarius-cta-buttons">/', $html);
        $this->assertDoesNotMatchRegularExpression('/hero-strip-card-center"[^>]*data-animate/', $html);
    }

    public function test_hero_lcp_image_has_high_fetch_priority_and_is_not_lazy(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertMatchesRegularExpression('/<img fetchpriority="high" src="[^"]*hero-image-1\.jpg"/', $html);
        $this->assertDoesNotMatchRegularExpression('/<img[^>]*fetchpriority="high"[^>]*loading="lazy"/', $html);
    }

    public function test_hero_video_plays_inline_and_has_a_poster(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertMatchesRegularExpression('/<video id="background-video"[^>]*\bplaysinline\b[^>]*poster="[^"]+hero-image-1\.webp"/', $html);
    }

    public function test_hero_video_toast_is_not_an_alert_and_links_are_not_typed_as_buttons(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertDoesNotMatchRegularExpression('/class="hero-video-toast"[^>]*role="alert"/', $html);
        $this->assertDoesNotMatchRegularExpression('/<a [^>]*type="button"[^>]*class="aquarius-cta-(primary|secondary)"/', $html);
    }

    public function test_hero_video_toggle_labels_follow_the_locale(): void
    {
        $this->get('/en')->assertOk()
            ->assertSee('Autoplay')
            ->assertSee('<span id="play-pause-text" class="ml-2 text-base">Pause</span>', false);

        $this->get('/ms')->assertOk()
            ->assertSee('Automain')
            ->assertSee('<span id="play-pause-text" class="ml-2 text-base">Jeda</span>', false)
            ->assertSee("const labelPlay = 'Main'", false)
            ->assertDontSee('Autoplay');
    }
}
