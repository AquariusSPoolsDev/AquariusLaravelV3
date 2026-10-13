<?php

namespace Tests\Feature;

use App\Filament\Resources\ImageGalleryResource\Pages\CreateImageGallery;
use App\Filament\Resources\ImageGalleryResource\Pages\EditImageGallery;
use App\Models\ImageGallery;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * Until the new public site launches, the old public site reads image_galleries straight from the
 * database and expects "image_gallery/<file>". The model stores that format and always hands the
 * rest of the app the bare file name, whichever format a row was saved in.
 *
 * phpunit.xml points at the development MySQL database. Every test runs inside a transaction
 * that is rolled back afterwards, so the throwaway rows are never kept.
 */
class ImageGalleryPathFormatTest extends TestCase
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

    private function rawPath(ImageGallery $image): string
    {
        return DB::table('image_galleries')->where('id', $image->id)->value('image_path');
    }

    private function makeImage(string $storedPath): ImageGallery
    {
        $id = DB::table('image_galleries')->insertGetId([
            'image_path' => $storedPath,
            'image_name' => 'Path format test',
            'image_tags' => json_encode(['Concrete']),
            'is_published' => 1,
            'uploader_id' => $this->admin->id,
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        return ImageGallery::query()->findOrFail($id);
    }

    public function test_saving_stores_the_old_site_format(): void
    {
        $image = ImageGallery::query()->create([
            'image_path' => 'path-test.jpg',
            'image_name' => 'Path format test',
            'image_tags' => ['Concrete'],
            'is_published' => false,
        ]);

        $this->assertSame('image_gallery/path-test.jpg', $this->rawPath($image));
        $this->assertSame('path-test.jpg', $image->fresh()->image_path);
    }

    public function test_rows_in_either_format_read_as_the_bare_file_name(): void
    {
        $this->assertSame('legacy.jpg', $this->makeImage('image_gallery/legacy.jpg')->image_path);
        $this->assertSame('bare.jpg', $this->makeImage('bare.jpg')->image_path);
    }

    public function test_uploading_in_the_admin_stores_the_old_site_format(): void
    {
        Livewire::test(CreateImageGallery::class)
            ->fillForm([
                'image_path' => [UploadedFile::fake()->image('new-upload.jpg')],
                'image_name' => 'Admin upload',
                'image_tags' => ['Concrete'],
                'is_published' => true,
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $image = ImageGallery::query()->where('image_name', 'Admin upload')->firstOrFail();

        $this->assertSame('image_gallery/new-upload.jpg', $this->rawPath($image));
        Storage::disk('public')->assertExists('image_gallery/new-upload.jpg');
    }

    public function test_editing_without_a_new_image_keeps_the_image_file(): void
    {
        Storage::disk('public')->put('image_gallery/keep-me.jpg', 'image');
        $image = $this->makeImage('image_gallery/keep-me.jpg');

        Livewire::test(EditImageGallery::class, ['record' => $image->getRouteKey()])
            ->fillForm(['image_name' => 'Renamed in admin'])
            ->call('save')
            ->assertHasNoFormErrors();

        Storage::disk('public')->assertExists('image_gallery/keep-me.jpg');
        $this->assertSame('image_gallery/keep-me.jpg', $this->rawPath($image));
        $this->assertSame('Renamed in admin', $image->fresh()->image_name);
    }

    public function test_deleting_removes_the_file_for_either_format(): void
    {
        Storage::disk('public')->put('image_gallery/legacy-delete.jpg', 'image');
        Storage::disk('public')->put('image_gallery/bare-delete.jpg', 'image');

        $this->makeImage('image_gallery/legacy-delete.jpg')->delete();
        $this->makeImage('bare-delete.jpg')->delete();

        Storage::disk('public')->assertMissing('image_gallery/legacy-delete.jpg');
        Storage::disk('public')->assertMissing('image_gallery/bare-delete.jpg');
    }
}
