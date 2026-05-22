<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class CustReview extends Model
{
    protected $table = 'cust_reviews';

    protected $fillable = [
        'reviewer_name',
        'reviewer_location',
        'review',
        'rating',
        'is_published',
        'source',
        'reviewed_at',
    ];

    protected function casts(): array
    {
        return [
            'reviewed_at' => 'date',
            'is_published' => 'boolean',
        ];
    }
}
