<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
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

    /**
     * @param  Builder<ContactSubmission>  $query
     */
    public function scopeUnread(Builder $query): void
    {
        $query->where('status', 'new');
    }

    /**
     * Marks a new enquiry as read once someone opens it. Enquiries already marked read or spam are left alone.
     */
    public function markAsRead(): void
    {
        if ($this->status === 'new') {
            $this->update(['status' => 'read']);
        }
    }
}
