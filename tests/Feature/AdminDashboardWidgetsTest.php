<?php

namespace Tests\Feature;

use App\Filament\Widgets\DashboardStatsWidget;
use App\Filament\Widgets\ImageGalleryWidget;
use App\Filament\Widgets\LatestEnquiriesWidget;
use App\Filament\Widgets\PromotionsWidget;
use App\Filament\Widgets\ReviewsWidget;
use App\Models\ImageGallery;
use App\Models\User;
use Filament\Facades\Filament;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Read-only tests — phpunit.xml points at the development MySQL database,
 * so these must never use RefreshDatabase or write records.
 */
class AdminDashboardWidgetsTest extends TestCase
{
    private const ADMIN_EMAIL = 'admin@aquariusswimmingpools.com';

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel('admin');
    }

    private function actingAsAdmin(): User
    {
        $admin = User::query()->where('email', self::ADMIN_EMAIL)->first();

        if (! $admin) {
            $this->markTestSkipped('The seeded admin user is not in this database.');
        }

        $this->actingAs($admin);

        return $admin;
    }

    public function test_dashboard_page_loads_for_admin(): void
    {
        $this->actingAsAdmin();

        $this->get('/admin')->assertOk();
    }

    public function test_contact_submissions_list_still_loads_with_shared_columns(): void
    {
        $this->actingAsAdmin();

        $this->get('/admin/contact-submissions')->assertOk();
    }

    public function test_stats_widget_renders_its_stats(): void
    {
        $this->actingAsAdmin();

        Livewire::test(DashboardStatsWidget::class)
            ->assertOk()
            ->assertSee('New enquiries')
            ->assertSee('Average rating')
            ->assertSee('Gallery images')
            ->assertSee('Active promotions');
    }

    public function test_latest_enquiries_widget_renders(): void
    {
        $this->actingAsAdmin();

        Livewire::test(LatestEnquiriesWidget::class)
            ->assertOk()
            ->assertSee('Latest enquiries');
    }

    public function test_reviews_gallery_and_promotions_widgets_render(): void
    {
        $this->actingAsAdmin();

        Livewire::test(ReviewsWidget::class)->assertOk()->assertSee('Reviews');
        Livewire::test(ImageGalleryWidget::class)->assertOk()->assertSee('Showcase gallery');
        Livewire::test(PromotionsWidget::class)->assertOk()->assertSee('Promotions');
    }

    public function test_gallery_widget_hides_extra_tags_behind_a_toggle(): void
    {
        $this->actingAsAdmin();

        $tagCount = ImageGallery::query()
            ->get(['id', 'image_tags'])
            ->flatMap(fn (ImageGallery $image): array => $image->image_tags ?? [])
            ->unique()
            ->count();

        if ($tagCount <= 10) {
            $this->markTestSkipped('This database has 10 or fewer tags, so there is nothing to toggle.');
        }

        $html = Livewire::test(ImageGalleryWidget::class)
            ->assertSee("{$tagCount} tags in use · Show all")
            ->assertSee('Show less')
            ->html();

        $hiddenTagCount = $tagCount - 10;
        $toggleLabelCount = 2;

        $this->assertSame($hiddenTagCount + $toggleLabelCount, substr_count($html, 'x-show="showAllTags"'));
    }

    public function test_stats_are_hidden_for_resources_the_user_cannot_view(): void
    {
        $this->actingAs(User::factory()->make(['email' => 'no-role@aquariusswimmingpools.com']));

        Livewire::test(DashboardStatsWidget::class)
            ->assertOk()
            ->assertDontSee('Gallery images')
            ->assertDontSee('Active promotions');
    }
}
