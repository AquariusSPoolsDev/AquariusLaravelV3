<?php

namespace App\Models;

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

    // Relationship with User model
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }
}
