<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * Top navigation: Our Pools / Our Work / Our Services / Visit Showroom, with Book a Free Assessment going to the
 * Contact page. Links follow Page Visibility, and only the current page is marked aria-current.
 */
class NavbarTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        foreach (SitePage::cases() as $page) {
            $page->setVisible(true);
        }
    }

    private function navbarHtml(string $path): string
    {
        $html = $this->get($path)->assertOk()->getContent();

        $start = strpos($html, '<div class="nav-content-details">');
        $end = strpos($html, '<div class="side-nav-content">');

        $this->assertNotFalse($start);
        $this->assertNotFalse($end);

        return substr($html, $start, $end - $start);
    }

    public function test_navbar_has_no_homepage_or_about_link(): void
    {
        $nav = $this->navbarHtml('/en/faq');

        $this->assertStringNotContainsString('href="'.url('/en').'"', $nav);
        $this->assertStringNotContainsString(url('/en/about-us'), $nav);
    }

    public function test_compare_pool_types_comes_first_in_our_pools(): void
    {
        $nav = $this->navbarHtml('/en');

        $comparePosition = strpos($nav, url('/en/our-pools').'#compare');
        $concretePosition = strpos($nav, url('/en/concrete-pools'));

        $this->assertNotFalse($comparePosition);
        $this->assertLessThan($concretePosition, $comparePosition);
        $this->assertStringContainsString('Compare Pool Types', $nav);
    }

    public function test_our_work_lists_showcase_reviews_and_projects(): void
    {
        $nav = $this->navbarHtml('/en');

        $this->assertStringContainsString(url('/en/showcase'), $nav);
        $this->assertStringContainsString(url('/en/reviews'), $nav);
        $this->assertStringContainsString(url('/en/projects'), $nav);
    }

    public function test_switched_off_pages_drop_out_of_the_navbar(): void
    {
        SitePage::Reviews->setVisible(false);
        SitePage::Projects->setVisible(false);
        SitePage::VinylPools->setVisible(false);

        $nav = $this->navbarHtml('/en');

        $this->assertStringNotContainsString(url('/en/reviews'), $nav);
        $this->assertStringNotContainsString(url('/en/projects'), $nav);
        $this->assertStringNotContainsString(url('/en/vinyl-pools'), $nav);
        $this->assertStringContainsString(url('/en/showcase'), $nav);
    }

    public function test_only_the_current_page_is_marked_current(): void
    {
        $this->assertStringNotContainsString('aria-current', $this->navbarHtml('/en/faq'));

        $nav = $this->navbarHtml('/en/vinyl-pools');

        $this->assertSame(1, substr_count($nav, 'aria-current="page"'));
        $this->assertMatchesRegularExpression('#href="'.preg_quote(url('/en/vinyl-pools'), '#').'"\s+aria-current="page"#', $nav);
    }

    public function test_dropdown_button_is_active_on_its_pages(): void
    {
        $this->assertDoesNotMatchRegularExpression('/nav-dropdown-btn nav-link-active/', $this->navbarHtml('/en/faq'));

        $nav = $this->navbarHtml('/en/our-pool-services');

        $this->assertSame(1, substr_count($nav, 'nav-dropdown-btn nav-link-active'));
        $this->assertMatchesRegularExpression('/nav-dropdown-btn nav-link-active[^>]*>\s*Our Services/', $nav);
    }

    public function test_navbar_uses_plain_links_not_menu_roles(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertStringNotContainsString('role="menu"', $html);
        $this->assertStringNotContainsString('role="menuitem"', $html);
    }

    public function test_visit_showroom_and_get_a_quote_go_to_the_contact_page(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertStringContainsString('href="'.url('/en/contact-us').'#showpool"', $this->navbarHtml('/en'));
        $this->assertStringContainsString('Visit Showroom', $this->navbarHtml('/en'));
        $this->assertStringContainsString('href="'.url('/en/contact-us').'?interest=Free+Pool+Assessment" class="quote-btn"', $html);
        $this->assertStringNotContainsString('#contact" class="quote-btn"', $html);
    }

    public function test_pool_supply_shop_opens_in_a_new_tab(): void
    {
        $nav = $this->navbarHtml('/en');

        $this->assertMatchesRegularExpression('#href="https://thesplashshop.com/" target="_blank" rel="noopener"#', $nav);
        $this->assertStringContainsString('(opens in a new tab)', $nav);
    }

    public function test_footer_showroom_link_goes_to_the_contact_page_without_about_us(): void
    {
        SitePage::AboutUs->setVisible(false);

        $this->get('/en/faq')->assertOk()
            ->assertSee('href="'.url('/en/contact-us').'#showpool"', false)
            ->assertDontSee(url('/en/about-us'), false);
    }

    public function test_navbar_labels_are_in_malay_on_malay_pages(): void
    {
        $nav = $this->navbarHtml('/ms');

        $this->assertStringContainsString('Bandingkan Jenis Kolam', $nav);
        $this->assertStringContainsString('Ulasan Pelanggan', $nav);
        $this->assertStringContainsString('Lawati Bilik Pameran', $nav);
        $this->assertStringContainsString('(dibuka di tab baharu)', $nav);
        $this->assertStringContainsString(url('/ms/contact-us').'#showpool', $nav);
    }
}
