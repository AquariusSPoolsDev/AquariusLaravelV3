<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages;
use App\Filament\Resources\ReviewResource\RelationManagers;
use App\Models\Review;
use Filament\Forms;
use Filament\Forms\Components\ViewField;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Symfony\Component\Yaml\Inline;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static ?string $navigationIcon = 'heroicon-o-star';
    protected static ?string $navigationLabel = 'Reviews';
    protected static ?string $navigationGroup = 'Content Management';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static ?string $navigationBadgeTooltip = 'Total Reviews Count';

    public static function form(Form $form): Form
    {
        return $form->schema([
            Forms\Components\TextInput::make('reviewer_name')
                ->label('Reviewer Name')
                ->required(),
                Forms\Components\TextInput::make('reviewer_location')
                ->label('Reviewer Location'),
            Forms\Components\RichEditor::make('review')
                ->required()
                ->label('Review')
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
            Forms\Components\Radio::make('rating')
                ->options([
                    '1' => '1. Poor',
                    '2' => '2. Fair',
                    '3' => '3. Good',
                    '4' => '4. Very Good',
                    '5' => '5. Excellent'
                ])
                ->inline()
                ->columnSpanFull(),
        ]);
    }


    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\TextColumn::make('review')
                    ->label('Review')
                    ->description(fn(Review $record): string => '- ' . $record->reviewer_name.' from '.$record->reviewer_location)
                    ->searchable()
                    ->wrap()
                    ->html(),
                Tables\Columns\TextColumn::make('rating')
                    ->label('Rating')
                    ->icon(fn(string $state): string => match ($state) {
                        '1' => 'heroicon-o-star',
                        '2' => 'heroicon-o-star',
                        '3' => 'heroicon-o-star',
                        '4' => 'heroicon-o-star',
                        '5' => 'heroicon-o-star',
                    }),
                Tables\Columns\TextColumn::make('created_at')
                    ->label('Created at')
                    ->dateTime()
                    ->timezone('Asia/Kuala_Lumpur')
                    ->wrap(),
            ])
            ->actions([
                Tables\Actions\ViewAction::make(),
                Tables\Actions\EditAction::make(),
            ])
            ->filters([
                //
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getRelations(): array
    {
        return [
            //
        ];
    }

    public static function getPages(): array
    {
        return [
            'index' => Pages\ListReviews::route('/'),
            'create' => Pages\CreateReview::route('/create'),
            'edit' => Pages\EditReview::route('/{record}/edit'),
        ];
    }
}
