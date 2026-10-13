<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

    /**
     * Folder on the public disk that holds the promotion images.
     */
    public const DIRECTORY = 'promotion_materials';

    protected $table = 'promotions';

    protected $fillable = [
        'title',
        'description',
        'start_time',
        'end_time',
        'file_attachment',
        'uploader_id',
    ];

    protected $casts = [
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    protected static function booted(): void
    {
        static::creating(function (Promotion $promotion) {
            $promotion->uploader_id ??= auth()->id();
        });
    }

    /**
     * Stored as ["promotion_materials/<file>", ...], the format the old public site reads from the shared
     * database. Always read back as bare file names, whichever format a row was saved in.
     */
    protected function fileAttachment(): Attribute
    {
        return Attribute::make(
            get: fn (?string $value): ?array => $value === null
                ? null
                : array_map(self::fileName(...), json_decode($value, true) ?? []),
            set: fn (?array $value): ?string => $value === null
                ? null
                : json_encode(array_values(array_map(fn (string $path): string => self::DIRECTORY.'/'.self::fileName($path), $value))),
        );
    }

    /**
     * Strips the storage directory from a stored or uploaded attachment path.
     */
    public static function fileName(string $path): string
    {
        return ltrim(str_replace(self::DIRECTORY.'/', '', $path), '/');
    }

    /**
     * Running right now. Times are stored in UTC, so compare against now() in the app timezone (UTC),
     * never a Malaysia-time Carbon. A promotion without an end time runs until it is removed.
     *
     * @param  Builder<Promotion>  $query
     */
    public function scopeActive(Builder $query): void
    {
        $now = now();

        $query->where('start_time', '<=', $now)
            ->where(fn (Builder $query) => $query->whereNull('end_time')->orWhere('end_time', '>=', $now));
    }

    /**
     * @param  Builder<Promotion>  $query
     */
    public function scopeUpcoming(Builder $query): void
    {
        $query->where('start_time', '>', now());
    }

    // Relationship with User model
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }
}
