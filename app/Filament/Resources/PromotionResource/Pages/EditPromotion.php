<?php

namespace App\Filament\Resources\PromotionResource\Pages;

use App\Filament\Resources\PromotionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditPromotion extends EditRecord
{
    protected static string $resource = PromotionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        $promotion = $this->record;
        $oldAttachments = $promotion->file_attachment ?? [];
        $newAttachments = $this->data['file_attachment'] ?? $oldAttachments;

        $filesToDelete = array_diff($oldAttachments, $newAttachments);
        foreach ($filesToDelete as $path) {
            Storage::disk('public')->delete('promotion_materials/'.$path);
        }
    }
}
