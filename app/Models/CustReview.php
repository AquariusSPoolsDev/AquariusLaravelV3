<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CustReview extends Model
{
    /**
     * Cache key for the published-review rating shown in the sitewide LocalBusiness schema.
     */
    public const RATING_CACHE_KEY = 'local-business-review-rating';

    protected $table = 'cust_reviews';

    protected static function booted(): void
    {
        static::saved(fn () => Cache::forget(self::RATING_CACHE_KEY));
        static::deleted(fn () => Cache::forget(self::RATING_CACHE_KEY));
    }

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
