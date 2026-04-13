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

    // Relationship with User model
    public function uploader()
    {
        return $this->belongsTo(User::class, 'uploader_id');
    }
}