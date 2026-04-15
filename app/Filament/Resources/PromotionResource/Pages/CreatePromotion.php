<?php

namespace App\Filament\Resources\PromotionResource\Pages;

use Exception;
use App\Filament\Resources\PromotionResource;
use Filament\Actions;
use Filament\Resources\Pages\CreateRecord;
use Illuminate\Support\Facades\Auth;

class CreatePromotion extends CreateRecord
{
    protected static string $resource = PromotionResource::class;

    protected function mutateFormDataBeforeSave(array $data): array
{
    $userId = Auth::id();
    if (!$userId) {
        throw new Exception('User is not authenticated.'); // This will help you debug
    }
    $data['uploader_id'] = $userId;
    return $data;
}
}
