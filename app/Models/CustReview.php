<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Cache;

class CustReview extends Model
{
    use HasFactory;

    /**
     * Cache key for the published-review rating shown in the sitewide LocalBusiness schema.
     */
    public const RATING_CACHE_KEY = 'local-business-review-rating';

    public const SOURCE_GOOGLE = 'Google Reviews';

    public const SOURCE_FACEBOOK = 'Facebook';

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

    /**
     * Only reviews staff have published. Every public page uses this, so hidden reviews never count.
     *
     * @param  Builder<CustReview>  $query
     */
    public function scopePublished(Builder $query): void
    {
        $query->where('is_published', true);
    }

    /**
     * Published review numbers for the Google and Facebook pills (homepage and Reviews page), in one query.
     *
     * @return array{googleAverage: float, googleTotal: int, facebookTotal: int}
     */
    public static function platformSummary(): array
    {
        $platforms = static::query()
            ->published()
            ->whereIn('source', [self::SOURCE_GOOGLE, self::SOURCE_FACEBOOK])
            ->toBase()
            ->selectRaw('source, COUNT(*) as total, AVG(rating) as average')
            ->groupBy('source')
            ->get()
            ->keyBy('source');

        return [
            'googleAverage' => round((float) ($platforms->get(self::SOURCE_GOOGLE)?->average ?? 0), 1),
            'googleTotal' => (int) ($platforms->get(self::SOURCE_GOOGLE)?->total ?? 0),
            'facebookTotal' => (int) ($platforms->get(self::SOURCE_FACEBOOK)?->total ?? 0),
        ];
    }
}
