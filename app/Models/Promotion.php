<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promotion extends Model
{
    use HasFactory;

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
        'file_attachment' => 'array',
        'start_time' => 'datetime',
        'end_time' => 'datetime',
    ];

    public function setFileAttachmentAttribute(mixed $value): void
    {
        if (is_array($value)) {
            $value = array_map(fn (string $path) => ltrim(str_replace('promotion_materials/', '', $path), '/'), $value);
        }
        $this->attributes['file_attachment'] = json_encode($value);
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
