<?php

namespace App\Filament\Resources\Projects\Schemas;

use App\Enums\PoolTags;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Schemas\Components\Grid;
use Filament\Schemas\Components\Section;
use Filament\Schemas\Schema;
use Illuminate\Support\Str;

class ProjectForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema->components([
            Section::make('Project Details')
                ->schema([
                    TextInput::make('title')
                        ->required()
                        ->maxLength(255)
                        ->live(onBlur: true)
                        ->afterStateUpdated(function (string $operation, $state, callable $set) {
                            if ($operation === 'create') {
                                $set('slug', Str::slug($state));
                            }
                        }),

                    TextInput::make('slug')
                        ->required()
                        ->maxLength(255)
                        ->unique(ignoreRecord: true)
                        ->helperText('Auto-generated from title. Edit only if needed.'),

                    Grid::make(2)
                        ->schema([
                            TextInput::make('location')
                                ->maxLength(255),

                            TextInput::make('year_completed')
                                ->label('Year Completed')
                                ->numeric()
                                ->minValue(1900)
                                ->maxValue(2100)
                                ->placeholder('e.g. 2019'),
                        ]),

                    RichEditor::make('description')
                        ->columnSpanFull()
                        ->toolbarButtons([
                            'bold',
                            'italic',
                            'link',
                            'bulletList',
                            'orderedList',
                            'redo',
                            'undo',
                        ]),
                ]),

            Section::make('Tags')
                ->schema([
                    Select::make('tags')
                        ->multiple()
                        ->options(PoolTags::options())
                        ->searchable()
                        ->columnSpanFull(),
                ]),

            Section::make('Images')
                ->description('Upload project images. The first image will be used as the cover.')
                ->schema([
                    FileUpload::make('gallery_images')
                        ->label('Project Images')
                        ->image()
                        ->multiple()
                        ->reorderable()
                        ->disk('public')
                        ->directory('projects/gallery')
                        ->visibility('public')
                        ->columnSpanFull(),
                ]),

            Section::make('Publishing')
                ->schema([
                    Grid::make(2)
                        ->schema([
                            Toggle::make('is_published')
                                ->label('Published')
                                ->default(false),

                            TextInput::make('sort_order')
                                ->label('Sort Order')
                                ->numeric()
                                ->default(0)
                                ->helperText('Lower number = appears first.'),
                        ]),
                ]),
        ]);
    }
}
