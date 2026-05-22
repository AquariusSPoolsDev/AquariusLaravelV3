<?php

namespace App\Filament\Resources\CustReviews;

use App\Filament\Resources\CustReviews\Pages\CreateCustReview;
use App\Filament\Resources\CustReviews\Pages\EditCustReview;
use App\Filament\Resources\CustReviews\Pages\ListCustReviews;
use App\Filament\Resources\CustReviews\Schemas\CustReviewForm;
use App\Filament\Resources\CustReviews\Tables\CustReviewsTable;
use App\Models\CustReview;
use BackedEnum;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Table;

class CustReviewResource extends Resource
{
    protected static ?string $model = CustReview::class;

    protected static string|BackedEnum|null $navigationIcon = Heroicon::OutlinedStar;

    protected static string|\UnitEnum|null $navigationGroup = 'Content Management';

    protected static ?string $navigationLabel = 'Customer Reviews';

    protected static ?int $navigationSort = 4;

    protected static ?string $modelLabel = 'Customer Review';

    protected static ?string $pluralModelLabel = 'Customer Reviews';

    public static function getNavigationBadge(): ?string
    {
        return static::getModel()::count() ?: null;
    }

    public static function form(Schema $schema): Schema
    {
        return CustReviewForm::configure($schema);
    }

    public static function table(Table $table): Table
    {
        return CustReviewsTable::configure($table);
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
            'index' => ListCustReviews::route('/'),
            'create' => CreateCustReview::route('/create'),
            'edit' => EditCustReview::route('/{record}/edit'),
        ];
    }
}
