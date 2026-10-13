<?php

namespace App\Observers;

use App\Models\Promotion;
use Illuminate\Support\Facades\Storage;

class PromotionObserver
{
    public function deleted(Promotion $promotion): void
    {
        foreach ($promotion->file_attachment ?? [] as $fileName) {
            Storage::disk('public')->delete(Promotion::DIRECTORY.'/'.$fileName);
        }
    }
}
