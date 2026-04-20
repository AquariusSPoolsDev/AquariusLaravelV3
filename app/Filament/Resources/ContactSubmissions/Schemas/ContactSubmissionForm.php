<?php

namespace App\Filament\Resources\ContactSubmissions\Schemas;

use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class ContactSubmissionForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('name')
                    ->required(),
                TextInput::make('email')
                    ->email()
                    ->required(),
                TextInput::make('phone')
                    ->tel()
                    ->required(),
                TextInput::make('interest')
                    ->nullable(),
                TextInput::make('interest_other')
                    ->label('Others (specify)')
                    ->nullable(),
                Textarea::make('query')
                    ->columnSpanFull()
                    ->nullable(),
                Select::make('status')
                    ->options([
                        'new' => 'New',
                        'read' => 'Read',
                        'spam' => 'Spam',
                    ])
                    ->required()
                    ->default('new'),
            ]);
    }
}
