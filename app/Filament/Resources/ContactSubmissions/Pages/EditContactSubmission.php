<?php

namespace App\Filament\Resources\ContactSubmissions\Pages;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use Filament\Actions\DeleteAction;
use Filament\Resources\Pages\EditRecord;

class EditContactSubmission extends EditRecord
{
    protected static string $resource = ContactSubmissionResource::class;

    /**
     * Runs before the form is filled, so the form loads the "read" status and saving doesn't revert it to "new".
     */
    protected function beforeFill(): void
    {
        $this->getRecord()->markAsRead();
    }

    protected function getHeaderActions(): array
    {
        return [
            DeleteAction::make(),
        ];
    }
}
