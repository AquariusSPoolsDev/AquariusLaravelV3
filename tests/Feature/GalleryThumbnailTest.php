<?php

namespace Tests\Feature;

use App\Filament\Resources\ImageGalleryResource\Pages\EditImageGallery;
use App\Models\ImageGallery;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Gallery photos average ~670 KB but show as small tiles, so each photo gets a WebP copy in
 * image_gallery/thumbs. The originals stay as they are: the old public site still reads them.
 */
class GalleryThumbnailTest extends TestCase
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
    }

    /**
     * Saves a real JPEG of the given size into the gallery folder and returns its bytes.
     */
    private function putPhoto(string $fileName, int $width, int $height): string
    {
        $image = imagecreatetruecolor($width, $height);
        imagefill($image, 0, 0, imagecolorallocate($image, 49, 112, 185));

        ob_start();
        imagejpeg($image, null, 90);
        $bytes = ob_get_clean();

        Storage::disk('public')->put(ImageGallery::DIRECTORY.'/'.$fileName, $bytes);

        return $bytes;
    }

    private function createRow(string $fileName): ImageGallery
    {
        return ImageGallery::query()->create([
            'image_path' => $fileName,
            'image_name' => 'Thumbnail test',
            'image_tags' => ['Concrete'],
            'is_published' => 1,
            'uploader_id' => $this->admin->id,
        ]);
    }

    /**
     * @return array{0: int, 1: int}
     */
    private function thumbnailSize(string $fileName): array
    {
        $size = getimagesizefromstring(Storage::disk('public')->get(ImageGallery::thumbnailPath($fileName)));

        return [$size[0], $size[1]];
    }

    public function test_a_new_photo_gets_a_small_webp_copy_and_the_original_is_untouched(): void
    {
        $original = $this->putPhoto('thumb-new.jpg', 2000, 1500);

        $this->createRow('thumb-new.jpg');

        Storage::disk('public')->assertExists('image_gallery/thumbs/thumb-new.jpg.webp');
        $this->assertSame([800, 600], $this->thumbnailSize('thumb-new.jpg'));
        $this->assertSame('image/webp', getimagesizefromstring(Storage::disk('public')->get('image_gallery/thumbs/thumb-new.jpg.webp'))['mime']);
        $this->assertSame($original, Storage::disk('public')->get('image_gallery/thumb-new.jpg'));
    }

    public function test_a_small_photo_is_not_enlarged(): void
    {
        $this->putPhoto('thumb-small.jpg', 500, 300);

        $this->createRow('thumb-small.jpg');

        $this->assertSame([500, 300], $this->thumbnailSize('thumb-small.jpg'));
    }

    public function test_photos_with_the_same_name_but_another_type_keep_separate_copies(): void
    {
        $this->assertSame('image_gallery/thumbs/pool.jpg.webp', ImageGallery::thumbnailPath('pool.jpg'));
        $this->assertSame('image_gallery/thumbs/pool.png.webp', ImageGallery::thumbnailPath('image_gallery/pool.png'));
    }

    public function test_an_unreadable_file_still_saves_and_the_page_shows_the_original(): void
    {
        Storage::disk('public')->put('image_gallery/not-a-photo.jpg', 'image');

        $image = $this->createRow('not-a-photo.jpg');

        $this->assertTrue($image->exists);
        Storage::disk('public')->assertMissing(ImageGallery::thumbnailPath('not-a-photo.jpg'));
        $this->assertSame(asset('storage/image_gallery/not-a-photo.jpg'), $image->thumbnailUrl());
    }

    public function test_the_grid_shows_the_copy_and_opens_the_full_photo(): void
    {
        $this->putPhoto('thumb-grid.jpg', 1200, 900);
        $image = $this->createRow('thumb-grid.jpg');

        $html = view('components.image-gallery.grid', ['images' => collect([$image]), 'galleryId' => 'gallery_'])->render();

        $this->assertStringContainsString('href="'.asset('storage/image_gallery/thumb-grid.jpg').'"', $html);
        $this->assertStringContainsString('src="'.asset('storage/image_gallery/thumbs/thumb-grid.jpg.webp').'"', $html);
    }

    public function test_replacing_the_photo_in_the_admin_swaps_its_copy(): void
    {
        Filament::setCurrentPanel('admin');
        $this->actingAs($this->admin);

        $this->putPhoto('thumb-old.jpg', 1000, 1000);
        $image = $this->createRow('thumb-old.jpg');
        $this->putPhoto('thumb-replacement.jpg', 1600, 900);

        Livewire::test(EditImageGallery::class, ['record' => $image->getRouteKey()])
            ->fillForm(['image_path' => ['image_gallery/thumb-replacement.jpg']])
            ->call('save')
            ->assertHasNoFormErrors();

        Storage::disk('public')->assertMissing('image_gallery/thumb-old.jpg');
        Storage::disk('public')->assertMissing('image_gallery/thumbs/thumb-old.jpg.webp');
        Storage::disk('public')->assertExists('image_gallery/thumbs/thumb-replacement.jpg.webp');
    }

    public function test_deleting_a_photo_removes_its_copy(): void
    {
        $this->putPhoto('thumb-delete.jpg', 900, 600);
        $image = $this->createRow('thumb-delete.jpg');

        $image->delete();

        Storage::disk('public')->assertMissing('image_gallery/thumb-delete.jpg');
        Storage::disk('public')->assertMissing('image_gallery/thumbs/thumb-delete.jpg.webp');
    }

    public function test_the_command_fills_in_missing_copies_without_changing_originals(): void
    {
        // An older upload: the row and photo exist, but no copy was ever made.
        $original = $this->putPhoto('thumb-older.jpg', 1800, 1200);
        DB::table('image_galleries')->insert([
            'image_path' => 'image_gallery/thumb-older.jpg',
            'image_name' => 'Older upload',
            'image_tags' => json_encode(['Concrete']),
            'is_published' => 1,
            'uploader_id' => $this->admin->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);
        $rowBefore = DB::table('image_galleries')->where('image_path', 'image_gallery/thumb-older.jpg')->first();

        $this->artisan('gallery:thumbnails')->assertSuccessful();

        Storage::disk('public')->assertExists('image_gallery/thumbs/thumb-older.jpg.webp');
        $this->assertSame([800, 533], $this->thumbnailSize('thumb-older.jpg'));
        $this->assertSame($original, Storage::disk('public')->get('image_gallery/thumb-older.jpg'));
        $this->assertEquals($rowBefore, DB::table('image_galleries')->where('id', $rowBefore->id)->first());
    }

    public function test_the_command_skips_copies_that_already_exist(): void
    {
        $this->putPhoto('thumb-existing.jpg', 1000, 800);
        $this->createRow('thumb-existing.jpg');
        Storage::disk('public')->put('image_gallery/thumbs/thumb-existing.jpg.webp', 'kept');

        $this->artisan('gallery:thumbnails')->assertSuccessful();
        $this->assertSame('kept', Storage::disk('public')->get('image_gallery/thumbs/thumb-existing.jpg.webp'));

        $this->artisan('gallery:thumbnails --force')->assertSuccessful();
        $this->assertSame([800, 640], $this->thumbnailSize('thumb-existing.jpg'));
    }
}
