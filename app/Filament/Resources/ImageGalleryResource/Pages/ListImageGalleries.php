<?php

namespace App\Filament\Resources\ImageGalleryResource\Pages;

use App\Filament\Resources\ImageGalleryResource;
use Filament\Actions\Action;
use Filament\Actions\CreateAction;
use Filament\Resources\Pages\ListRecords;
use Filament\Tables\Table;
use Livewire\Attributes\Url;

class ListImageGalleries extends ListRecords
{
    protected static string $resource = ImageGalleryResource::class;

    #[Url(as: 'view')]
    public string $viewMode = 'list';

    protected function getHeaderActions(): array
    {
        return [
            CreateAction::make(),
            Action::make('toggleView')
                ->label(fn (): string => $this->viewMode === 'list' ? 'Grid View' : 'List View')
                ->icon(fn (): string => $this->viewMode === 'list' ? 'heroicon-o-squares-2x2' : 'heroicon-o-list-bullet')
                ->color('gray')
                ->action(function (): void {
                    $this->viewMode = $this->viewMode === 'list' ? 'grid' : 'list';
                    $this->resetTable();
                }),
        ];
    }

    public function table(Table $table): Table
    {
        return ImageGalleryResource::table($table)
            ->content(fn ($livewire): ?\Illuminate\Contracts\View\View => $livewire->viewMode === 'grid'
                ? view('filament.tables.pool-images-grid')
                : null
            )
            ->selectable(fn ($livewire): bool => $livewire->viewMode !== 'grid');
    }
}
