<?php

namespace App\Filament\Resources\ImageGalleryResource\Pages;

use Filament\Actions\DeleteAction;
use App\Filament\Resources\ImageGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\EditRecord;
use Illuminate\Support\Facades\Storage;

class EditImageGallery extends EditRecord
{
    protected static string $resource = ImageGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }

    protected function beforeSave(): void
    {
        // Get the current record
        $gallery = $this->record;

        // Store old image path for comparison
        $oldImagePath = $gallery->image_path;

        // Check if a new image is uploaded
        if (isset($this->data['image_path'])) {
            // If an old image exists, delete it before saving the new one
            if ($oldImagePath) {
                Storage::disk('public')->delete($oldImagePath);
            }

            // Update the image path with the new uploaded image
            $gallery->image_path = $this->data['image_path'];
        }
    }
}
