<?php

namespace App\Filament\Resources\PromotionResource\Pages;

use App\Filament\Resources\PromotionResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditPromotion extends EditRecord
{
    protected static string $resource = PromotionResource::class;

    protected function getHeaderActions(): array
    {
        return [
            Actions\DeleteAction::make(),
        ];
    }

    // Ensure this method is public
    protected function beforeSave(): void
    {
        // Get the current record
        $promotion = $this->record;

        // Store old file attachments for comparison
        $oldAttachments = $promotion->file_attachment ?? [];

        // Check if new files are uploaded
        if (isset($this->data['file_attachment'])) {
            // If new files are uploaded, we will merge them with old attachments
            $newAttachments = $this->data['file_attachment'];

            // Determine which old files to keep and which to delete
            $filesToDelete = array_diff($oldAttachments, $newAttachments);

            // Delete old files that are not present in new uploads
            foreach ($filesToDelete as $oldFilePath) {
                Storage::disk('public')->delete($oldFilePath);
            }

            // Update the file_attachment field with new attachments merged with existing ones
            $promotion->file_attachment = array_merge($newAttachments, array_values($filesToDelete));
        } else {
            // If no new files are uploaded, just keep existing attachments
            $promotion->file_attachment = $oldAttachments;
        }
    }

}