<?php

namespace Tests\Feature;

use App\Filament\Resources\ImageGalleryResource\Pages\CreateImageGallery;
use App\Filament\Resources\Projects\Pages\CreateProject;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Livewire\Livewire;
use PHPUnit\Framework\Attributes\DataProvider;
use Tests\TestCase;

/**
 * Gallery and project photos are served from the public disk, so they only accept JPEG, PNG, GIF
 * and WebP. SVG is an image type too, but it can carry scripts that run when the file is opened.
 *
 * phpunit.xml points at the development MySQL database. Every test runs inside a transaction
 * that is rolled back afterwards, so the throwaway rows are never kept.
 */
class AdminUploadFileTypesTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        $admin = User::query()->where('email', 'admin@aquariusswimmingpools.com')->first();

        if (! $admin) {
            $this->markTestSkipped('The seeded admin user is not in this database.');
        }

        Storage::fake('public');
        Filament::setCurrentPanel('admin');
        $this->actingAs($admin);
    }

    private function svgUpload(): UploadedFile
    {
        return UploadedFile::fake()->createWithContent(
            'pool.svg',
            '<svg xmlns="http://www.w3.org/2000/svg"><script>alert(1)</script></svg>',
        );
    }

    /**
     * @return array<string, array{string}>
     */
    public static function photoFileNames(): array
    {
        return [
            'jpeg' => ['pool.jpg'],
            'png' => ['pool.png'],
            'gif' => ['pool.gif'],
            'webp' => ['pool.webp'],
        ];
    }

    public function test_gallery_rejects_svg_uploads(): void
    {
        Livewire::test(CreateImageGallery::class)
            ->fillForm([
                'image_path' => [$this->svgUpload()],
                'image_name' => 'SVG upload test',
                'image_tags' => ['Concrete'],
            ])
            ->call('create')
            ->assertHasFormErrors(['image_path']);

        $this->assertDatabaseMissing('image_galleries', ['image_name' => 'SVG upload test']);
    }

    #[DataProvider('photoFileNames')]
    public function test_gallery_accepts_photo_uploads(string $fileName): void
    {
        Livewire::test(CreateImageGallery::class)
            ->fillForm([
                'image_path' => [UploadedFile::fake()->image($fileName)],
                'image_name' => 'Photo upload test',
                'image_tags' => ['Concrete'],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('image_galleries', ['image_name' => 'Photo upload test']);
    }

    public function test_project_rejects_svg_uploads(): void
    {
        Livewire::test(CreateProject::class)
            ->fillForm([
                'title' => 'SVG upload test',
                'slug' => 'svg-upload-test',
                'gallery_images' => [$this->svgUpload()],
            ])
            ->call('create')
            ->assertHasFormErrors(['gallery_images']);

        $this->assertDatabaseMissing('projects', ['slug' => 'svg-upload-test']);
    }

    #[DataProvider('photoFileNames')]
    public function test_project_accepts_photo_uploads(string $fileName): void
    {
        Livewire::test(CreateProject::class)
            ->fillForm([
                'title' => 'Photo upload test',
                'slug' => 'photo-upload-test',
                'gallery_images' => [UploadedFile::fake()->image($fileName)],
            ])
            ->call('create')
            ->assertHasNoFormErrors();

        $this->assertDatabaseHas('projects', ['slug' => 'photo-upload-test']);
    }
}
