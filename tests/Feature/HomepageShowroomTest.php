<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * The homepage "Who we are" section says where the showroom is and when it is open, next to its photos,
 * so visitors don't have to open the Contact page to find out.
 */
class HomepageShowroomTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        SitePage::Homepage->setVisible(true);
        SitePage::ContactUs->setVisible(true);
    }

    public function test_homepage_shows_the_showroom_address_hours_and_directions(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertStringContainsString('data-showroom-details', $html);
        $this->assertStringContainsString('33, Jalan Selatan 3/4,', $html);
        $this->assertStringContainsString('8:00 AM - 5:00 PM', $html);
        $this->assertStringContainsString(e(__('strings.contact_close_sun')), $html);
        $this->assertStringContainsString('location:\'homepage_showroom\'', $html);
        $this->assertStringContainsString(e(__('strings.trust_showroom_more')), $html);
    }

    public function test_showroom_details_are_in_malay_on_the_malay_homepage(): void
    {
        $this->get('/ms')->assertOk()
            ->assertSee('Kunjungi Bilik Pameran Kolam Renang Kami')
            ->assertSee('Dapatkan arah')
            ->assertSee('Ketahui lebih lanjut tentang bilik pameran');
    }

    public function test_showroom_link_is_hidden_when_the_contact_page_is_off(): void
    {
        SitePage::ContactUs->setVisible(false);

        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertStringContainsString('data-showroom-details', $html);
        $this->assertStringNotContainsString(e(__('strings.trust_showroom_more')), $html);
    }

    public function test_numbers_are_plain_and_the_uppercase_member_label_is_gone(): void
    {
        $html = $this->get('/en')->assertOk()->getContent();

        $this->assertStringContainsString('data-trust-stats', $html);
        $this->assertStringNotContainsString('uppercase tracking-wide">'.__('strings.trust_member_of'), $html);
    }
}
