<?php

namespace Tests\Feature;

use App\Filament\Resources\ImageGalleryResource\Pages\ListImageGalleries;
use App\Models\CustReview;
use App\Models\ImageGallery;
use App\Models\Project;
use App\Models\Promotion;
use App\Models\User;
use Filament\Actions\DeleteBulkAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Covers the 2026-10 code-audit fixes (B2–B6, B8 and the LocalBusiness review rating).
 *
 * phpunit.xml points at the development MySQL database. Every test runs inside a transaction
 * that is rolled back afterwards, so nothing created here is kept.
 */
class AuditFixesTest extends TestCase
{
    use DatabaseTransactions;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $admin = User::query()->where('email', 'admin@aquariusswimmingpools.com')->first();

        if (! $admin) {
            $this->markTestSkipped('The seeded admin user is not in this database.');
        }

        $this->admin = $admin;
    }

    private function createPromotion(string $title, mixed $startTime, mixed $endTime): Promotion
    {
        return Promotion::query()->create([
            'title' => $title,
            'description' => 'Audit test promotion',
            'start_time' => $startTime,
            'end_time' => $endTime,
            'uploader_id' => $this->admin->id,
        ]);
    }

    public function test_promotion_scopes_compare_in_utc(): void
    {
        // Starts in 2 hours. The old Malaysia-time query (UTC+8) treated this as already running.
        $startsSoon = $this->createPromotion('Starts soon', now()->addHours(2), now()->addDays(3));
        // Ended 2 hours ago. The old query kept showing it for another 6 hours.
        $justEnded = $this->createPromotion('Just ended', now()->subDays(3), now()->subHours(2));
        $running = $this->createPromotion('Running', now()->subDay(), now()->addDay());

        $activeIds = Promotion::query()->active()->pluck('id');

        $this->assertTrue($activeIds->contains($running->id));
        $this->assertFalse($activeIds->contains($startsSoon->id));
        $this->assertFalse($activeIds->contains($justEnded->id));
        $this->assertTrue(Promotion::query()->upcoming()->pluck('id')->contains($startsSoon->id));
    }

    public function test_promotion_without_an_end_time_stays_active_and_renders(): void
    {
        $openEnded = $this->createPromotion('Open-ended audit promo', now()->subDay(), null);

        $this->assertTrue(Promotion::query()->active()->pluck('id')->contains($openEnded->id));

        $this->get('/en/promotions')
            ->assertOk()
            ->assertSee('Open-ended audit promo')
            ->assertSee('until further notice');
    }

    public function test_gallery_loads_with_and_without_a_search_term(): void
    {
        $this->get('/en/showcase')->assertOk();
        $this->get('/en/showcase?search=')->assertOk();
        $this->get('/en/showcase?search=pool')->assertOk();
    }

    public function test_bulk_deleting_images_removes_records_and_files(): void
    {
        Storage::fake('public');
        Filament::setCurrentPanel('admin');
        $this->actingAs($this->admin);

        $images = collect(['audit-a.jpg', 'audit-b.jpg'])->map(function (string $fileName): ImageGallery {
            Storage::disk('public')->put('image_gallery/'.$fileName, 'image');

            return ImageGallery::query()->create([
                'image_path' => $fileName,
                'image_name' => 'Audit '.$fileName,
                'image_tags' => ['Concrete'],
                'is_published' => false,
            ]);
        });

        Livewire::test(ListImageGalleries::class)
            ->callTableBulkAction(DeleteBulkAction::class, $images)
            ->assertHasNoErrors();

        foreach ($images as $image) {
            $this->assertModelMissing($image);
            Storage::disk('public')->assertMissing('image_gallery/'.$image->image_path);
        }
    }

    public function test_renaming_a_project_keeps_its_url_slug(): void
    {
        $project = Project::query()->create(['title' => 'Audit Villa Pool']);

        $this->assertSame('audit-villa-pool', $project->slug);

        $project->update(['title' => 'Audit Villa Pool Renamed']);

        $this->assertSame('audit-villa-pool', $project->fresh()->slug);

        $project->update(['slug' => 'audit-villa-pool-new']);

        $this->assertSame('audit-villa-pool-new', $project->fresh()->slug);
    }

    public function test_pages_print_exactly_one_robots_meta_tag(): void
    {
        $indexedPage = $this->get('/en/faq')->assertOk()->getContent();
        $hiddenPage = $this->get('/en/terms')->assertOk()->getContent();

        $this->assertSame(1, substr_count($indexedPage, 'name="robots"'));
        $this->assertStringContainsString('<meta name="robots" content="index, follow" />', $indexedPage);

        $this->assertSame(1, substr_count($hiddenPage, 'name="robots"'));
        $this->assertStringContainsString('<meta name="robots" content="noindex, nofollow" />', $hiddenPage);
    }

    public function test_local_business_rating_uses_published_customer_reviews(): void
    {
        Cache::forget(CustReview::RATING_CACHE_KEY);

        $publishedCount = CustReview::query()->where('is_published', true)->count();

        if ($publishedCount === 0) {
            $this->markTestSkipped('No published customer reviews in this database.');
        }

        $this->get('/en')
            ->assertOk()
            ->assertSee('"reviewCount": "'.$publishedCount.'"', false);
    }

    public function test_saving_a_review_clears_the_cached_rating(): void
    {
        Cache::put(CustReview::RATING_CACHE_KEY, ['count' => 999, 'average' => 1.0]);

        CustReview::query()->create([
            'reviewer_name' => 'Audit Reviewer',
            'review' => 'Great pool',
            'rating' => 5,
            'is_published' => false,
            'source' => 'Manual',
            'reviewed_at' => now(),
        ]);

        $this->assertNull(Cache::get(CustReview::RATING_CACHE_KEY));
    }
}
