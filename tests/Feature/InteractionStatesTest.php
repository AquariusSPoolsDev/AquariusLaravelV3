<?php

namespace Tests\Feature;

use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\Concerns\ShowsAllPages;
use Tests\TestCase;

/**
 * One hover/press standard across the site: buttons shrink to 95% when pressed, link cards lift on hover and
 * shrink to 97%, photo links get a blue inner outline and shrink to 97% (photos never zoom), and text links
 * give the same feedback on press as on hover so touch screens see it too.
 */
class InteractionStatesTest extends TestCase
{
    use DatabaseTransactions;
    use ShowsAllPages;

    private const PHOTO_LINK = 'hover:outline-3 hover:-outline-offset-3 hover:outline-primary-600 active:scale-97';

    public function test_photos_never_zoom_on_hover(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));

        $this->assertDoesNotMatchRegularExpression('/hover:scale-1\d\d/', $css);

        foreach (['/en', '/en/concrete-pools', '/en/vinyl-pools', '/en/fibreglass-pools', '/en/projects'] as $path) {
            $this->assertDoesNotMatchRegularExpression('/hover:scale-1\d\d/', $this->get($path)->assertOk()->getContent(), $path);
        }
    }

    public function test_photo_links_share_one_hover_and_press_style(): void
    {
        $this->assertSame(3, substr_count($this->get('/en/concrete-pools')->assertOk()->getContent(), self::PHOTO_LINK));
        $this->assertSame(4, substr_count($this->get('/en')->assertOk()->getContent(), self::PHOTO_LINK));
        $this->assertStringContainsString(self::PHOTO_LINK, file_get_contents(resource_path('css/app.css')));
    }

    public function test_link_cards_press_to_97_percent(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));

        $this->assertMatchesRegularExpression('/\.aquarius-homepage-pool-card \{\n\s*@apply [^;]*active:scale-97/', $css);
        $this->assertMatchesRegularExpression('/\.aquarius-homepage-service-card \{\n\s*@apply [^;]*active:scale-97/', $css);
        // the projects grid may be empty in the test database, so check the template itself
        $this->assertStringContainsString('active:translate-y-0 active:scale-97 active:shadow-none', file_get_contents(resource_path('views/pages/17-projects.blade.php')));
    }

    public function test_text_links_react_to_a_tap_like_they_do_to_hover(): void
    {
        $privacy = $this->get('/en/privacy')->assertOk()->getContent();
        $this->assertSame(substr_count($privacy, 'hover:no-underline"'), 0);
        $this->assertGreaterThan(0, substr_count($privacy, 'hover:no-underline active:no-underline'));

        $this->assertStringContainsString('hover:underline active:underline', $this->get('/en')->assertOk()->getContent());
    }

    public function test_boxes_that_are_not_links_do_not_move_on_hover(): void
    {
        $css = file_get_contents(resource_path('css/app.css'));

        $this->assertDoesNotMatchRegularExpression('/\.pool-service-relative \{\n\s*@apply [^;]*(active|hover):/', $css);
    }

    public function test_explore_other_pools_cards_lift_and_press_with_a_transition(): void
    {
        $html = $this->get('/en/fibreglass-pools')->assertOk()->getContent();

        $this->assertSame(2, substr_count($html, 'group transition-all duration-300 hover:-translate-y-1'));
        $this->assertSame(2, substr_count($html, 'active:translate-y-0 active:scale-97 active:shadow-none'));
        $this->assertDoesNotMatchRegularExpression('/data-current-pool[^>]*class="[^"]*(hover|active):/', $html);
    }
}
