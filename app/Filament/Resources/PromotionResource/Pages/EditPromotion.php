<?php

namespace App\Filament\Resources\PromotionResource\Pages;

use App\Filament\Resources\PromotionResource;
use App\Models\Promotion;
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
        $oldAttachments = $this->record->file_attachment ?? [];

        // The form holds "promotion_materials/<file>" (keyed by upload id) and the record bare file names,
        // so compare file names only. Otherwise every existing image looks removed and gets deleted.
        $newAttachments = array_map(
            Promotion::fileName(...),
            array_values($this->data['file_attachment'] ?? $oldAttachments),
        );

        foreach (array_diff($oldAttachments, $newAttachments) as $fileName) {
            Storage::disk('public')->delete(Promotion::DIRECTORY.'/'.$fileName);
        }
    }
}
