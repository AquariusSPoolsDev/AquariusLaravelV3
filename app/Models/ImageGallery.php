<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Storage;

class ImageGallery extends Model
{
    use HasFactory;

    /**
     * Folder on the public disk that holds the gallery images.
     */
    public const DIRECTORY = 'image_gallery';

    /**
     * Small copies for grids and tiles, kept apart from the originals, which the old public site still reads.
     */
    public const THUMBNAIL_DIRECTORY = self::DIRECTORY.'/thumbs';

    /**
     * Wide enough for the widest homepage showcase tile on a 2x phone screen.
     */
    public const THUMBNAIL_WIDTH = 800;

    public const THUMBNAIL_QUALITY = 75;

    protected $table = 'image_galleries';

    protected $fillable = [
        'image_path',
        'image_name',
        'image_description',
        'image_tags',
        'is_published',
        'is_featured',
        'uploader_id',
    ];

    protected $casts = [
        'image_tags' => 'array', // Cast JSON field to array
    ];

    protected static function booted(): void
    {
        static::creating(function (ImageGallery $imageGallery) {
            $imageGallery->uploader_id ??= auth()->id();
        });

        // A new or replaced photo gets its small copy straight away.
        static::saved(function (ImageGallery $imageGallery) {
            if ($imageGallery->image_path && ($imageGallery->wasRecentlyCreated || $imageGallery->wasChanged('image_path'))) {
                self::makeThumbnail($imageGallery->image_path);
            }
        });

        // Remove the image file with its record, however it is deleted (single, bulk or in code).
        static::deleted(function (ImageGallery $imageGallery) {
            if ($imageGallery->image_path) {
                self::deleteFiles($imageGallery->image_path);
            }
        });
    }

    /**
     * Public-disk path of a photo's small copy. The original extension stays in the name,
     * so "pool.jpg" and "pool.png" never share one copy.
     */
    public static function thumbnailPath(string $fileName): string
    {
        return self::THUMBNAIL_DIRECTORY.'/'.self::fileName($fileName).'.webp';
    }

    /**
     * URL of the small copy for grids and tiles, or of the original while no copy exists.
     */
    public function thumbnailUrl(): string
    {
        $disk = Storage::disk('public');

        return $disk->exists(self::thumbnailPath($this->image_path))
            ? asset('storage/'.self::thumbnailPath($this->image_path))
            : asset('storage/'.self::DIRECTORY.'/'.$this->image_path);
    }

    /**
     * Writes a WebP copy at most THUMBNAIL_WIDTH wide, upright and with transparency kept.
     * Never blocks a save: an unreadable file is logged and the page shows the original.
     */
    public static function makeThumbnail(string $fileName): bool
    {
        $disk = Storage::disk('public');
        $originalPath = self::DIRECTORY.'/'.self::fileName($fileName);

        if (! $disk->exists($originalPath)) {
            return false;
        }

        $source = @imagecreatefromstring($disk->get($originalPath));

        if ($source === false) {
            Log::warning('Gallery thumbnail skipped: not a readable image.', ['file' => $originalPath]);

            return false;
        }

        $source = self::uprightImage($source, $disk->path($originalPath));

        $width = imagesx($source);
        $height = imagesy($source);
        $targetWidth = min($width, self::THUMBNAIL_WIDTH);
        $targetHeight = max(1, (int) round($height * $targetWidth / $width));

        $thumbnail = imagecreatetruecolor($targetWidth, $targetHeight);
        imagealphablending($thumbnail, false);
        imagesavealpha($thumbnail, true);
        imagecopyresampled($thumbnail, $source, 0, 0, 0, 0, $targetWidth, $targetHeight, $width, $height);

        ob_start();
        imagewebp($thumbnail, null, self::THUMBNAIL_QUALITY);
        $webp = ob_get_clean();

        return $webp !== '' && $disk->put(self::thumbnailPath($fileName), $webp, 'public');
    }

    /**
     * Removes a photo and its small copy.
     */
    public static function deleteFiles(string $fileName): void
    {
        Storage::disk('public')->delete([
            self::DIRECTORY.'/'.self::fileName($fileName),
            self::thumbnailPath($fileName),
        ]);
    }

    /**
     * Browsers turn phone photos upright from their EXIF tag; GD does not, and the copy has no tag.
     */
    private static function uprightImage(\GdImage $image, string $absolutePath): \GdImage
    {
        $orientation = function_exists('exif_read_data')
            ? (@exif_read_data($absolutePath)['Orientation'] ?? 1)
            : 1;

        $rotated = match ((int) $orientation) {
            3 => imagerotate($image, 180, 0),
            6 => imagerotate($image, 270, 0),
            8 => imagerotate($image, 90, 0),
            default => $image,
        };

        return $rotated ?: $image;
    }

    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }

    // Mutator to handle image_tags as an array
    public function getImageTagsAttribute($value)
    {
        return json_decode($value, true);
    }

    // Accessor to store image_tags as JSON
    public function setImageTagsAttribute($value)
    {
        $this->attributes['image_tags'] = json_encode($value);
    }

    /**
     * Stored as "image_gallery/<file>", the format the old public site reads from the shared database.
     * Always read back as the bare file name, whichever format a row was saved in.
     */
    protected function imagePath(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): ?string => $value === null ? null : self::fileName($value),
            set: fn (string|array $value): string => self::DIRECTORY.'/'.self::fileName(is_array($value) ? array_values($value)[0] : $value),
        );
    }

    /**
     * Strips the storage directory from a stored or uploaded image path.
     */
    public static function fileName(string $path): string
    {
        return ltrim(str_replace(self::DIRECTORY.'/', '', $path), '/');
    }

    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }

    public function scopeFeatured($query)
    {
        return $query->where('is_featured', 1);
    }
}
