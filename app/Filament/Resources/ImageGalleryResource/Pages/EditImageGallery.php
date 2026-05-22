<?php

namespace App\Filament\Resources\ImageGalleryResource\Pages;

use App\Filament\Resources\ImageGalleryResource;
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
        $gallery = $this->record;
        $oldImagePath = $gallery->image_path;
        $newImagePath = is_array($this->data['image_path'] ?? null)
            ? array_values($this->data['image_path'])[0] ?? null
            : ($this->data['image_path'] ?? null);

        if ($newImagePath && $oldImagePath && $oldImagePath !== $newImagePath) {
            Storage::disk('public')->delete('image_gallery/'.$oldImagePath);
        }
    }
}
