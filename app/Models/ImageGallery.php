<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImageGallery extends Model
{
    use HasFactory;

    protected $table = 'image_galleries';

    protected $fillable = [
        'image_path',
        'image_name',
        'image_description',
        'image_tags',
        'is_published',
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

    public function setImagePathAttribute(string|array $value): void
    {
        $value = is_array($value) ? array_values($value)[0] : $value;
        $this->attributes['image_path'] = ltrim(str_replace('image_gallery/', '', $value), '/');
    }

    // Scope to filter published images
    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }
}
