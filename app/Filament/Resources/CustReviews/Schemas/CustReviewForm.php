<?php

namespace App\Filament\Resources\CustReviews\Schemas;

use Filament\Forms\Components\DatePicker;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Schema;

class CustReviewForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('reviewer_name')
                    ->label('Reviewer Name')
                    ->required(),
                Select::make('source')
                    ->label('Platform / Source')
                    ->options([
                        'Manual' => 'Manual',
                        'Google Reviews' => 'Google Reviews',
                        'Facebook' => 'Facebook',
                    ])
                    ->default('Manual')
                    ->required(),
                TextInput::make('reviewer_location')
                    ->label('Reviewer Location')
                    ->placeholder('e.g. Johor Bahru, Kuala Lumpur')
                    ->hint('Optional — fill in if you know where the reviewer is from.'),
                RichEditor::make('review')
                    ->label('Review')
                    ->required()
                    ->columnSpanFull()
                    ->toolbarButtons([
                        'bold',
                        'italic',
                        'link',
                        'redo',
                        'strike',
                        'underline',
                        'undo',
                    ]),
                Radio::make('rating')
                    ->options([
                        '1' => '1. Poor',
                        '2' => '2. Fair',
                        '3' => '3. Good',
                        '4' => '4. Very Good',
                        '5' => '5. Excellent',
                    ])
                    ->inline()
                    ->required()
                    ->columnSpanFull(),
                DatePicker::make('reviewed_at')
                    ->label('Date of Review')
                    ->native(false)
                    ->displayFormat('d M Y')
                    ->maxDate(now()),
                Toggle::make('is_published')
                    ->label('Published'),
            ]);
    }
}
