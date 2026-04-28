<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ReviewResource\Pages\CreateReview;
use App\Filament\Resources\ReviewResource\Pages\EditReview;
use App\Filament\Resources\ReviewResource\Pages\ListReviews;
use App\Models\Review;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\Radio;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class ReviewResource extends Resource
{
    protected static ?string $model = Review::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-star';

    protected static ?string $navigationLabel = 'Reviews';

    protected static string|\UnitEnum|null $navigationGroup = 'Content Management';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count();
    }

    protected static string|\Illuminate\Contracts\Support\Htmlable|null $navigationBadgeTooltip = 'Total Reviews Count';

    public static function form(Schema $schema): Schema
    {
        return $schema->components([
            TextInput::make('reviewer_name')
                ->label('Reviewer Name')
                ->required(),
            TextInput::make('reviewer_location')
                ->label('Reviewer Location'),
            RichEditor::make('review')
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
            Radio::make('rating')
                ->options([
                    '1' => '1. Poor',
                    '2' => '2. Fair',
                    '3' => '3. Good',
                    '4' => '4. Very Good',
                    '5' => '5. Excellent',
                ])
                ->inline()
                ->columnSpanFull(),
            Toggle::make('is_published')
                ->label('Published')
                ->columnSpanFull(),
        ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('review')
                    ->label('Review')
                    ->description(fn (Review $record): string => '- '.$record->reviewer_name.' from '.$record->reviewer_location)
                    ->searchable()
                    ->wrap()
                    ->html(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->icon(fn (string $state): string => match ($state) {
                        '1' => 'heroicon-o-star',
                        '2' => 'heroicon-o-star',
                        '3' => 'heroicon-o-star',
                        '4' => 'heroicon-o-star',
                        '5' => 'heroicon-o-star',
                    }),
                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),
                TextColumn::make('created_at')
                    ->label('Created at')
                    ->dateTime()
                    ->timezone('Asia/Kuala_Lumpur')
                    ->wrap(),
            ])
            ->recordActions([
                ViewAction::make(),
                EditAction::make(),
            ])
            ->filters([
                //
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    DeleteBulkAction::make(),
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
            'index' => ListReviews::route('/'),
            'create' => CreateReview::route('/create'),
            'edit' => EditReview::route('/{record}/edit'),
        ];
    }
}
