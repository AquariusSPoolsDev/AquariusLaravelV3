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

    /**
     * The video sits under an 80% blue tint, so a 720p copy looks the same as the old 5.3 MB 1080p file.
     * A new file name means Cloudflare and browsers never keep serving the old one.
     */
    public function test_hero_video_is_the_compressed_copy(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();
        $videoPath = public_path('assets/videos/aquarius-homepage-hero-video-720.mp4');

        $this->assertStringContainsString('assets/videos/aquarius-homepage-hero-video-720.mp4', $html);
        $this->assertFileExists($videoPath);
        $this->assertLessThan(1.5 * 1024 * 1024, filesize($videoPath));
    }

    /**
     * The "Autoplay ×" pill was only a label that looked like a toggle; the Pause/Play button is the one control.
     */
    public function test_hero_has_only_the_pause_control_and_links_are_not_typed_as_buttons(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertStringNotContainsString('hero-video-toast', $html);
        $this->assertSame(1, substr_count($html, 'id="play-pause-btn"'));
        $this->assertDoesNotMatchRegularExpression('/<a [^>]*type="button"[^>]*class="aquarius-cta-(primary|secondary)"/', $html);
    }

    public function test_hero_video_toggle_labels_follow_the_locale(): void
    {
        $this->get('/en')->assertOk()
            ->assertSee('<span id="play-pause-text" class="ml-2 text-base">Pause</span>', false)
            ->assertDontSee('Autoplay');

        $this->get('/ms')->assertOk()
            ->assertSee('<span id="play-pause-text" class="ml-2 text-base">Jeda</span>', false)
            ->assertSee("const labelPlay = 'Main'", false)
            ->assertDontSee('Automain');
    }
}
