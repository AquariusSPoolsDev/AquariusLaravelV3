<?php

namespace App\Filament\Resources\GoogleReviews\Tables;

use App\Models\GoogleReview;
use Filament\Actions\Action;
use Filament\Infolists\Components\TextEntry;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;

class GoogleReviewsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                TextColumn::make('author_name')
                    ->label('Reviewer')
                    ->searchable(),
                TextColumn::make('rating')
                    ->label('Rating')
                    ->sortable()
                    ->formatStateUsing(fn (int $state): string => str_repeat('★', $state).str_repeat('☆', 5 - $state)),
                TextColumn::make('text')
                    ->label('Review')
                    ->wrap()
                    ->limit(120),
                TextColumn::make('relative_time_description')
                    ->label('When'),
                TextColumn::make('published_at')
                    ->label('Published')
                    ->date()
                    ->sortable(),
            ])
            ->defaultSort('published_at', 'desc')
            ->recordActions([
                Action::make('view')
                    ->label('Read')
                    ->icon('heroicon-o-eye')
                    ->infolist(fn (Schema $schema, GoogleReview $record): Schema => $schema->components([
                        TextEntry::make('author_name')->label('Reviewer'),
                        TextEntry::make('rating')
                            ->formatStateUsing(fn (int $state): string => str_repeat('★', $state).str_repeat('☆', 5 - $state)),
                        TextEntry::make('relative_time_description')->label('Posted'),
                        TextEntry::make('text')->label('Review')->columnSpanFull(),
                    ]))
                    ->modalHeading(fn (GoogleReview $record): string => 'Review by '.$record->author_name)
                    ->modalSubmitAction(false)
                    ->modalCancelActionLabel('Close'),
            ])
            ->toolbarActions([]);
    }
}
