<?php

namespace App\Filament\Resources\GoogleReviews\Pages;

use App\Filament\Resources\GoogleReviews\GoogleReviewResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditGoogleReview extends EditRecord
{
    protected static string $resource = GoogleReviewResource::class;

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
