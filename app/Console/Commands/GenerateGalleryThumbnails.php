<?php

namespace App\Console\Commands;

use App\Models\ImageGallery;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;

/**
 * Makes the small WebP copies for photos uploaded before copies existed.
 * Only adds files to image_gallery/thumbs: originals and database rows are never changed.
 */
class GenerateGalleryThumbnails extends Command
{
    /**
     * @var string
     */
    protected $signature = 'gallery:thumbnails {--force : Remake copies that already exist}';

    /**
     * @var string
     */
    protected $description = 'Create the small gallery copies that are missing (originals are not touched)';

    public function handle(): int
    {
        $disk = Storage::disk('public');
        $made = 0;
        $skipped = 0;
        $failed = [];

        foreach (ImageGallery::query()->whereNotNull('image_path')->lazyById() as $image) {
            if (! $this->option('force') && $disk->exists(ImageGallery::thumbnailPath($image->image_path))) {
                $skipped++;

                continue;
            }

            if (ImageGallery::makeThumbnail($image->image_path)) {
                $made++;
            } else {
                $failed[] = $image->image_path;
            }
        }

        $this->info("Copies made: {$made}. Already there: {$skipped}. Failed: ".count($failed).'.');

        foreach ($failed as $fileName) {
            $this->warn("  Missing or unreadable: {$fileName}");
        }

        return self::SUCCESS;
    }
}
