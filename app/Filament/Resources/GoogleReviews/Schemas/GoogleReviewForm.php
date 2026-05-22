<?php

namespace App\Filament\Resources\GoogleReviews\Schemas;

use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Schemas\Schema;

class GoogleReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('author_name')
                    ->required(),
                TextInput::make('author_photo_url')
                    ->url(),
                TextInput::make('author_url')
                    ->url(),
                TextInput::make('rating')
                    ->required()
                    ->numeric(),
                Textarea::make('text')
                    ->columnSpanFull(),
                TextInput::make('relative_time_description'),
                DateTimePicker::make('published_at'),
            ]);
    }
}
