<?php

namespace Tests\Feature;

use App\Filament\Resources\PromotionResource\Pages\CreatePromotion;
use App\Filament\Resources\PromotionResource\Pages\EditPromotion;
use App\Models\Promotion;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Until the new public site launches, the old public site reads promotions from the shared database and
 * expects ["promotion_materials/<file>", ...]. The model stores that format and reads back bare names.
 *
 * phpunit.xml points at the development MySQL database. Every test runs inside a transaction
 * that is rolled back afterwards, so the throwaway promotions are never kept.
 */
class PromotionAttachmentTest extends TestCase
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
        Storage::fake('public');
        Filament::setCurrentPanel('admin');
        $this->actingAs($this->admin);
    }

    /**
     * @return array<int, string>
     */
    private function rawAttachments(Promotion $promotion): array
    {
        return json_decode(DB::table('promotions')->where('id', $promotion->id)->value('file_attachment'), true);
    }

    /**
     * @param  array<int, string>  $storedPaths
     */
    private function makePromotion(array $storedPaths): Promotion
    {
        foreach ($storedPaths as $path) {
            Storage::disk('public')->put(Promotion::DIRECTORY.'/'.Promotion::fileName($path), 'image');
        }

        $id = DB::table('promotions')->insertGetId([
            'title' => 'Attachment test',
            'description' => 'Attachment test promotion',
            'start_time' => now()->subDay(),
            'end_time' => now()->addDay(),
            'file_attachment' => json_encode($storedPaths),
            'uploader_id' => $this->admin->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return Promotion::query()->findOrFail($id);
    }

    public function test_creating_in_the_admin_records_the_uploader_and_the_old_site_format(): void
    {
        Livewire::test(CreatePromotion::class)
            ->fillForm([
                'title' => 'Admin promotion',
                'description' => 'Created from the admin',
                'start_time' => now()->addDay(),
                'end_time' => now()->addDays(8),
                'file_attachment' => [UploadedFile::fake()->image('promo-a.jpg'), UploadedFile::fake()->image('promo-b.jpg')],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $promotion = Promotion::query()->where('title', 'Admin promotion')->firstOrFail();

        $this->assertSame($this->admin->id, $promotion->uploader_id);
        $this->assertSame(['promotion_materials/promo-a.jpg', 'promotion_materials/promo-b.jpg'], $this->rawAttachments($promotion));
        $this->assertSame(['promo-a.jpg', 'promo-b.jpg'], $promotion->file_attachment);
        Storage::disk('public')->assertExists(['promotion_materials/promo-a.jpg', 'promotion_materials/promo-b.jpg']);
    }

    public function test_rows_in_either_format_read_as_bare_file_names(): void
    {
        $promotion = $this->makePromotion(['promotion_materials/legacy.jpg', 'bare.jpg']);

        $this->assertSame(['legacy.jpg', 'bare.jpg'], $promotion->file_attachment);
    }

    public function test_saving_without_changing_images_keeps_every_file(): void
    {
        $promotion = $this->makePromotion(['promotion_materials/keep-1.jpg', 'promotion_materials/keep-2.jpg']);

        Livewire::test(EditPromotion::class, ['record' => $promotion->getRouteKey()])
            ->fillForm(['title' => 'Renamed promotion'])
            ->call('save')
            ->assertHasNoFormErrors();

        Storage::disk('public')->assertExists(['promotion_materials/keep-1.jpg', 'promotion_materials/keep-2.jpg']);
        $this->assertSame(['promotion_materials/keep-1.jpg', 'promotion_materials/keep-2.jpg'], $this->rawAttachments($promotion));
        $this->assertSame('Renamed promotion', $promotion->fresh()->title);
    }

    public function test_removing_one_image_deletes_only_that_file(): void
    {
        $promotion = $this->makePromotion(['promotion_materials/stays.jpg', 'promotion_materials/goes.jpg']);

        Livewire::test(EditPromotion::class, ['record' => $promotion->getRouteKey()])
            ->fillForm(['file_attachment' => ['promotion_materials/stays.jpg']])
            ->call('save')
            ->assertHasNoFormErrors();

        Storage::disk('public')->assertExists('promotion_materials/stays.jpg');
        Storage::disk('public')->assertMissing('promotion_materials/goes.jpg');
        $this->assertSame(['promotion_materials/stays.jpg'], $this->rawAttachments($promotion));
    }

    public function test_deleting_a_promotion_removes_its_files(): void
    {
        $promotion = $this->makePromotion(['promotion_materials/old-format.jpg', 'new-format.jpg']);

        $promotion->delete();

        Storage::disk('public')->assertMissing(['promotion_materials/old-format.jpg', 'promotion_materials/new-format.jpg']);
    }
}
