<?php

namespace App\Filament\Resources\ImageGalleryResource\Pages;

use Filament\Actions\CreateAction;
use App\Filament\Resources\ImageGalleryResource;
use Filament\Actions;
use Filament\Resources\Pages\ListRecords;

class ListImageGalleries extends ListRecords
{
    protected static string $resource = ImageGalleryResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
