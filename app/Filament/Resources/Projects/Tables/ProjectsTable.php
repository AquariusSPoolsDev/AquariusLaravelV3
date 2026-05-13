<?php

namespace App\Filament\Resources\Projects\Tables;

use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\TernaryFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ProjectsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('gallery_images')
                    ->label('Cover')
                    ->disk('public')
                    ->extraImgAttributes(['style' => 'width:80px;height:50px;object-fit:cover;border-radius:0.25rem;'])
                    ->state(fn ($record) => collect($record->gallery_images)->first()),

                TextColumn::make('title')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('location')
                    ->searchable()
                    ->sortable(),

                TextColumn::make('year_completed')
                    ->label('Year')
                    ->sortable(),

                TextColumn::make('tags')
                    ->label('Tags')
                    ->badge()
                    ->separator(','),

                IconColumn::make('is_published')
                    ->label('Published')
                    ->boolean(),

                TextColumn::make('sort_order')
                    ->label('Order')
                    ->sortable(),
            ])
            ->filters([
                TernaryFilter::make('is_published')
                    ->label('Published'),
            ])
            ->recordActions([
                EditAction::make(),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('publish')
                        ->label('Publish All')
                        ->action(fn (Collection $records) => $records->each->update(['is_published' => true])),
                    BulkAction::make('unpublish')
                        ->label('Unpublish All')
                        ->action(fn (Collection $records) => $records->each->update(['is_published' => false])),
                    DeleteBulkAction::make(),
                ]),
            ])
            ->defaultSort('sort_order', 'asc');
    }
}
