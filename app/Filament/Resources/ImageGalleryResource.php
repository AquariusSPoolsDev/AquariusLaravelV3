<?php

namespace App\Filament\Resources;

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
use Filament\Tables\Columns\IconColumn;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class ImageGalleryResource extends Resource
{
    protected static ?string $model = ImageGallery::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-photo';

    protected static ?string $navigationLabel = 'Image Gallery';

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
                    ->options([
                        'Concrete' => 'Concrete',
                        'Vinyl' => 'Vinyl',
                        'Fibreglass' => 'Fibreglass',
                        'Skimmer' => 'Skimmer',
                        'Overflow' => 'Overflow',
                        'Infinity' => 'Infinity',
                        'Residential Pool' => 'Residential Pool',
                        'Commercial Pool' => 'Commercial Pool',
                        'Balinese' => 'Balinese',
                        'Lampang' => 'Lampang',
                        'Customised Tiling' => 'Customised Tiling',
                        'Jacuzzi' => 'Jacuzzi',
                        'Heated Pool' => 'Heated Pool',
                        'Kids Pool' => 'Kids Pool',
                        'Lightweight Panel Pool' => 'Lightweight Panel Pool',
                        'Timber Deck' => 'Timber Deck',
                        'Concrete Deck' => 'Concrete Deck',
                        'Water Features' => 'Water Features',
                        'Waterfall' => 'Waterfall',
                        'Nature' => 'Nature',
                        'Water Fountain' => 'Water Fountain',
                        'Oasis' => 'Oasis',
                        'Luxurious' => 'Luxurious',
                        'Landscape Design' => 'Landscape Design',
                        'Wading Pool' => 'Wading Pool',
                        'Private Pool' => 'Private Pool',
                        'Contemporary' => 'Contemporary',
                        'Swimming Pool' => 'Swimming Pool',
                        'Gazebos' => 'Gazebos',
                        'Minimalism' => 'Minimalism',
                        'LED Lights' => 'LED Lights',
                        'Fitness' => 'Fitness',
                        'Backyard' => 'Backyard',
                        'Mosaic Tiles' => 'Mosaic Tiles',
                        'Safety Fence' => 'Safety Fence',
                    ]),
                Toggle::make('is_published')
                    ->label('Publish this Image?')
                    ->default(0),
                TextInput::make('uploader_id')
                    ->default(Auth::id()) // Automatically set the current user's ID
                    ->label('Uploader ID')
                    ->hint('Ignore this field for validation purposes.')
                    ->readonly(),
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
                    ->description(fn (ImageGallery $record): string => $record->image_description)
                    ->wrap()
                    ->searchable(),
                TextColumn::make('image_tags')
                    ->label('Pool Tags')
                    ->badge()
                    ->separator(',')
                    ->wrap()
                    ->searchable(),
                IconColumn::make('is_published')
                    ->boolean()
                    ->label('Published'),
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
                SelectFilter::make('image_tags')
                    ->label('Pool Tags')
                    ->options([
                        'Concrete' => 'Concrete',
                        'Vinyl' => 'Vinyl',
                        'Fibreglass' => 'Fibreglass',
                        'Skimmer' => 'Skimmer',
                        'Overflow' => 'Overflow',
                        'Infinity' => 'Infinity',
                        'Residential Pool' => 'Residential Pool',
                        'Commercial Pool' => 'Commercial Pool',
                        'Balinese' => 'Balinese',
                        'Lampang' => 'Lampang',
                        'Customised Tiling' => 'Customised Tiling',
                        'Jacuzzi' => 'Jacuzzi',
                        'Heated Pool' => 'Heated Pool',
                        'Kids Pool' => 'Kids Pool',
                        'Lightweight Panel Pool' => 'Lightweight Panel Pool',
                        'Timber Deck' => 'Timber Deck',
                        'Concrete Deck' => 'Concrete Deck',
                        'Water Features' => 'Water Features',
                        'Waterfall' => 'Waterfall',
                        'Nature' => 'Nature',
                        'Water Fountain' => 'Water Fountain',
                        'Oasis' => 'Oasis',
                        'Luxurious' => 'Luxurious',
                        'Landscape Design' => 'Landscape Design',
                        'Wading Pool' => 'Wading Pool',
                        'Private Pool' => 'Private Pool',
                        'Contemporary' => 'Contemporary',
                        'Swimming Pool' => 'Swimming Pool',
                        'Gazebos' => 'Gazebos',
                        'Minimalism' => 'Minimalism',
                        'LED Lights' => 'LED Lights',
                        'Fitness' => 'Fitness',
                        'Backyard' => 'Backyard',
                        'Mosaic Tiles' => 'Mosaic Tiles',
                        'Safety Fence' => 'Safety Fence',
                    ])
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
                            Storage::disk('public')->delete($record->image_path);
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
                    DeleteBulkAction::make()->action(function (array $records) {
                        foreach ($records as $record) {
                            if ($record->image_path) {
                                Storage::disk('public')->delete($record->image_path);
                            }
                            $record->delete();
                        }
                    }),
                    BulkAction::make('Publish All')
                        ->action(function (Collection $records) {
                            $records->each->update(['is_published' => true]);
                        }),
                    BulkAction::make('Unpublish All')
                        ->action(function (Collection $records) {
                            $records->each->update(['is_published' => false]);
                        }),
                ]),
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
