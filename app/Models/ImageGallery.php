<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class ImageGallery extends Model
{
    use HasFactory;

    /**
     * Folder on the public disk that holds the gallery images.
     */
    public const DIRECTORY = 'image_gallery';

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

        // Remove the image file with its record, however it is deleted (single, bulk or in code).
        static::deleted(function (ImageGallery $imageGallery) {
            if ($imageGallery->image_path) {
                Storage::disk('public')->delete('image_gallery/'.$imageGallery->image_path);
            }
        });
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
