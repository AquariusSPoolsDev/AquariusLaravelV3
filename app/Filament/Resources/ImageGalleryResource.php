<?php

namespace App\Filament\Resources;

use App\Enums\PoolTags;
use App\Filament\Resources\ImageGalleryResource\Pages\CreateImageGallery;
use App\Filament\Resources\ImageGalleryResource\Pages\EditImageGallery;
use App\Filament\Resources\ImageGalleryResource\Pages\ListImageGalleries;
use App\Models\ImageGallery;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Forms\Components\Toggle;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ImageGalleryResource extends Resource
{
    protected static ?string $model = ImageGallery::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Pool Images';

    protected static ?int $navigationSort = 1;

    protected static ?string $modelLabel = 'Pool Image';

    protected static ?string $pluralModelLabel = 'Pool Images';

    protected static string|\UnitEnum|null $navigationGroup = 'Content Management';

    public static function getNavigationBadge(): ?string
    {
        return ImageGallery::where('is_published', true)->count();
    }

    protected static string|\Illuminate\Contracts\Support\Htmlable|null $navigationBadgeTooltip = 'Total Published Images';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                FileUpload::make('image_path')
                    ->required()
                    ->label('Image')
                    ->hint('Max 2MB each image. Available for cropping.')
                    ->columnSpanFull()
                    ->disk('public')
                    ->visibility('public')
                    ->preserveFilenames()
                    ->panelLayout('grid')
                    ->directory('image_gallery')
                    ->afterStateHydrated(function (FileUpload $component, ?string $state): void {
                        if ($state && ! str_starts_with($state, 'image_gallery/')) {
                            $component->state('image_gallery/'.$state);
                        }
                    })
                    ->image()
                    ->imageEditor()
                    ->imageEditorAspectRatios([
                        null,
                        '16:9',
                        '4:3',
                        '1:1',
                    ])
                    ->maxSize(2048),
                TextInput::make('image_name')
                    ->required()
                    ->label('Pool Name')
                    ->hint('Insert name that suits the image.')
                    ->columnSpanFull(),
                Textarea::make('image_description')
                    ->nullable()
                    ->label('Pool Details')
                    ->hint('Insert any information that suits the image.')
                    ->columnSpanFull(),
                Select::make('image_tags')
                    ->nullable()
                    ->label('Pool Image Tags')
                    ->hint('Use appropriate tags for the image')
                    ->multiple()
                    ->options(PoolTags::options()),
                Toggle::make('is_published')
                    ->label('Publish this Image?')
                    ->default(0),
                Toggle::make('is_featured')
                    ->label('Feature on Homepage?')
                    ->helperText('Up to 9 featured images are shown on the homepage showcase.')
                    ->default(false),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('image_path')
                    ->label('Image')
                    ->disk('public')
                    ->state(fn (ImageGallery $record): string => 'image_gallery/'.$record->image_path)
                    ->limit(1)
                    ->width(150)
                    ->height('auto')
                    ->extraImgAttributes(['style' => 'border-radius: 0.25rem; width: 150px; height: auto; object-fit: cover;']),
                TextColumn::make('image_name')
                    ->label('Pool Details')
                    ->description(fn (ImageGallery $record): string => str($record->image_description)->limit(80))
                    ->wrap()
                    ->searchable()
                    ->limit(40)
                    ->tooltip(fn (ImageGallery $record): ?string => strlen($record->image_name) > 40 ? $record->image_name : null),
                TextColumn::make('image_tags')
                    ->label('Pool Tags')
                    ->badge()
                    ->separator(',')
                    ->wrap()
                    ->searchable(),
                TextColumn::make('is_published')
                    ->label('Published')
                    ->state(fn (ImageGallery $record): string => $record->is_published ? 'Published' : 'Unpublished')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'Published' ? 'success' : 'danger'),
                TextColumn::make('is_featured')
                    ->label('Featured')
                    ->state(fn (ImageGallery $record): string => $record->is_featured ? 'Featured' : '—')
                    ->badge()
                    ->color(fn (string $state): string => $state === 'Featured' ? 'warning' : 'gray'),
                TextColumn::make('uploader.name')
                    ->label('Uploaded By')
                    ->wrap(),
                TextColumn::make('created_at')
                    ->dateTime()
                    ->wrap()
                    ->label('Uploaded Date')
                    ->timezone('Asia/Kuala_Lumpur'),
            ])
            ->filters([
                Filter::make('is_published')
                    ->query(fn (Builder $query) => $query->where('is_published', true))
                    ->label('Published'),
                Filter::make('is_featured')
                    ->query(fn (Builder $query) => $query->where('is_featured', true))
                    ->label('Featured on Homepage'),
                SelectFilter::make('image_tags')
                    ->label('Pool Tags')
                    ->options(PoolTags::options())
                    ->query(fn (Builder $query, array $data) => $query->when(
                        $data['value'],
                        fn (Builder $query, string $value) => $query->whereRaw('JSON_CONTAINS(image_tags, ?)', [json_encode($value)])
                    )),
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()->action(function ($record) {
                        // Delete associated image before deleting the record
                        if ($record->image_path) {
                            Storage::disk('public')->delete('image_gallery/'.$record->image_path);
                        }
                        // Now delete the record itself
                        $record->delete();
                    }),
                ])
                    ->button()
                    ->label('Actions'),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('publish')
                        ->label('Publish Selected')
                        ->icon('heroicon-o-eye')
                        ->action(fn (Collection $records) => $records->each->update(['is_published' => true]))
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('unpublish')
                        ->label('Unpublish Selected')
                        ->icon('heroicon-o-eye-slash')
                        ->action(fn (Collection $records) => $records->each->update(['is_published' => false]))
                        ->requiresConfirmation()
                        ->deselectRecordsAfterCompletion(),
                ])->label('Publish'),
                BulkActionGroup::make([
                    BulkAction::make('feature')
                        ->label('Feature Selected')
                        ->icon('heroicon-o-star')
                        ->requiresConfirmation()
                        ->modalHeading('Feature Selected Images')
                        ->modalDescription(function (Collection $records): string {
                            $currentCount = ImageGallery::where('is_featured', true)->count();
                            $afterCount = $currentCount + $records->count();

                            return "This will feature {$records->count()} image(s) on the homepage showcase. "
                                ."Currently {$currentCount}/9 slots are used. After this action: {$afterCount}/9. "
                                .($afterCount > 9 ? '⚠ Warning: exceeding 9 featured images — only the first 9 (by newest date) will be shown.' : 'This is within the 9-image limit.');
                        })
                        ->modalSubmitActionLabel('Feature Images')
                        ->action(fn (Collection $records) => $records->each->update(['is_featured' => true]))
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('unfeature')
                        ->label('Unfeature Selected')
                        ->icon('heroicon-o-star')
                        ->requiresConfirmation()
                        ->modalHeading('Remove from Homepage Showcase')
                        ->modalDescription('These images will no longer appear on the homepage showcase.')
                        ->modalSubmitActionLabel('Unfeature Images')
                        ->action(fn (Collection $records) => $records->each->update(['is_featured' => false]))
                        ->deselectRecordsAfterCompletion(),
                ])->label('Feature'),
                BulkActionGroup::make([
                    DeleteBulkAction::make()->action(function (array $records) {
                        foreach ($records as $record) {
                            if ($record->image_path) {
                                Storage::disk('public')->delete('image_gallery/'.$record->image_path);
                            }
                            $record->delete();
                        }
                    }),
                ])->label('Delete'),
            ])
            ->defaultSort('created_at', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListImageGalleries::route('/'),
            'create' => CreateImageGallery::route('/create'),
            'edit' => EditImageGallery::route('/{record}/edit'),
        ];
    }
}
