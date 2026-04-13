<?php

namespace App\Filament\Resources\ImageGalleryResource\Pages;

use App\Filament\Resources\ImageGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreateImageGallery extends CreateRecord
{
    protected static string $resource = ImageGalleryResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
    {
        $data['uploader_id'] = Auth::id();
        return $data;
    }
}
