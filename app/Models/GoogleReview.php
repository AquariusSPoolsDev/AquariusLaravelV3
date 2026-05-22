<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleReview extends Model
{
    protected $fillable = [
        'author_name',
        'author_photo_url',
        'author_url',
        'rating',
        'text',
        'relative_time_description',
        'published_at',
    ];

    protected function casts(): array
    {
        return [
            'published_at' => 'datetime',
            'rating' => 'integer',
        ];
    }
}
