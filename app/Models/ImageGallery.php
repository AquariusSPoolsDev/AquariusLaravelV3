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

    // Scope to filter published images
    public function scopePublished($query)
    {
        return $query->where('is_published', 1);
    }
}
