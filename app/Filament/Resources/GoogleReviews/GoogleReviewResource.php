<?php

namespace App\Filament\Resources\GoogleReviews;

use App\Filament\Resources\GoogleReviews\Pages\ListGoogleReviews;
use App\Filament\Resources\GoogleReviews\Tables\GoogleReviewsTable;
use App\Models\GoogleReview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;
use UnitEnum;

class GoogleReviewResource extends Resource
{
    protected static ?string $model = GoogleReview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static string|UnitEnum|null $navigationGroup = 'Content Management';

    protected static ?string $navigationLabel = 'Google Reviews';

    public static function canCreate(): bool
    {
        return false;
    }

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() ?: null;
    }

    public static function form(Schema $schema): Schema
    {
        return $schema->components([]);
    }

    public static function table(Table $table): Table
    {
        return GoogleReviewsTable::configure($table);
    }

    public static function getRelations(): array
    {
        return [];
    }

    public static function getPages(): array
    {
        return [
            'index' => ListGoogleReviews::route('/'),
        ];
    }
}
