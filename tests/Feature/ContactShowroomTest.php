<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * The Contact page showroom section (#showpool): what the showroom is, where it is, a directions link,
 * and photo slots that show labelled placeholders on local copies only, never on the live site.
 */
class ContactShowroomTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        SitePage::ContactUs->setVisible(true);
    }

    public function test_showroom_section_describes_the_display_pools_and_location(): void
    {
        $this->get('/en/contact-us')->assertOk()
            ->assertSee('id="showpool"', false)
            ->assertSee('three full-size display pools')
            ->assertSee('opposite Southern University College');

        $this->get('/ms/contact-us')->assertOk()
            ->assertSee('tiga kolam pameran saiz penuh')
            ->assertSee('Dapatkan arah');
    }

    public function test_directions_link_opens_google_maps_in_a_new_tab(): void
    {
        $this->get('/en/contact-us')->assertOk()
            ->assertSee('href="https://www.google.com/maps/dir/?api=1&amp;destination=Aquarius+Swimming+Pools+Sdn+Bhd', false)
            ->assertSee('target="_blank" rel="noopener"', false)
            ->assertSee('Get directions');
    }

    public function test_photo_placeholders_show_on_local_copies(): void
    {
        config(['app.debug' => true]);

        $this->get('/en/contact-us')->assertOk()
            ->assertSee('data-showroom-photos', false)
            ->assertSee('Photo needed: Showroom exterior')
            ->assertSee('Photo needed: Concrete display pool')
            ->assertSee('Photo needed: Vinyl display pool')
            ->assertSee('Photo needed: Fibreglass display pool')
            ->assertSee('Photo needed: Shop and office, inside');
    }

    public function test_photo_placeholders_never_show_on_the_live_site(): void
    {
        config(['app.debug' => false]);

        $this->get('/en/contact-us')->assertOk()
            ->assertDontSee('data-photo-placeholder', false)
            ->assertDontSee('Photo needed')
            ->assertSee('three full-size display pools');
    }
}
