<?php

namespace App\Filament\Resources\CustReviews\Pages;

use App\Filament\Resources\CustReviews\CustReviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditCustReview extends EditRecord
{
    protected static string $resource = CustReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
