<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ContactSubmission extends Model
{
    protected $fillable = [
        'name',
        'email',
        'country_code',
        'phone',
        'interest',
        'interest_other',
        'query',
        'agreed',
        'status',
    ];

    protected function casts(): array
    {
        return [
            'agreed' => 'boolean',
        ];
    }
}
