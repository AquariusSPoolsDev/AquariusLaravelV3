<?php

namespace App\Filament\Resources\ImageGalleryResource\Pages;

use App\Filament\Resources\ImageGalleryResource;
use App\Models\ImageGallery;
use Filament\Actions\DeleteAction;
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
        $oldImagePath = $this->record->image_path;
        $newImagePath = is_array($this->data['image_path'] ?? null)
            ? array_values($this->data['image_path'])[0] ?? null
            : ($this->data['image_path'] ?? null);

        // The form holds "image_gallery/<file>" and the record the bare file name, so compare file names only.
        if ($newImagePath && $oldImagePath && ImageGallery::fileName($newImagePath) !== $oldImagePath) {
            Storage::disk('public')->delete(ImageGallery::DIRECTORY.'/'.$oldImagePath);
        }
    }
}
