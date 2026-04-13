<?php

namespace App\Observers;

use App\Models\Promotion;
use Illuminate\Support\Facades\Storage;

class PromotionObserver
{
    public function deleted(Promotion $promotion): void
    {
        // Check if the file_attachment column has files
        if ($promotion->file_attachment) {
            // Loop through each file path and delete it
            foreach ($promotion->file_attachment as $filePath) {
                Storage::disk('public')->delete($filePath);
            }
        }
    }
}