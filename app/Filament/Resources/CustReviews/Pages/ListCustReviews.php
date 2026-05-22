<?php

namespace App\Filament\Resources\CustReviews\Pages;

use App\Filament\Resources\CustReviews\CustReviewResource;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;

class ListCustReviews extends ListRecords
{
    protected static string $resource = CustReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
        ];
    }
}
