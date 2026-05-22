<?php

namespace App\Filament\Resources\GoogleReviews\Pages;

use App\Filament\Resources\GoogleReviews\GoogleReviewResource;
use Filament\Resources\Pages\ListRecords;

class ListGoogleReviews extends ListRecords
{
    protected static string $resource = GoogleReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [];
    }
}
