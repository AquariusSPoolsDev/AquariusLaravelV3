<?php

namespace App\Filament\Resources;

use App\Filament\Resources\ImageGalleryResource\Pages;
use App\Models\ImageGallery;
use Filament\Forms;
use Filament\Tables;
use Filament\Resources\Resource;
use Filament\Tables\Actions\BulkAction;
use Filament\Tables\Filters\Filter;
use Filament\Tables\Filters\SelectFilter;
use Illuminate\Support\Facades\Auth;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class ImageGalleryResource extends Resource
{
    protected static ?string $model = ImageGallery::class;

    protected static ?string $navigationIcon = 'heroicon-o-photo';
    protected static ?string $navigationLabel = 'Image Gallery';
    protected static ?string $navigationGroup = 'Content Management';

    public static function getNavigationBadge(): ?string
    {
        return ImageGallery::where('is_published', true)->count();
    }

    protected static ?string $navigationBadgeTooltip = 'Total Published Images';

    public static function form(Forms\Form $form): Forms\Form
    {
        return $form
            ->schema([
                Forms\Components\FileUpload::make('image_path')
                    ->required()
                    ->label('Image')
                    ->hint('Max 2MB each image. Available for cropping.')
                    ->columnSpanFull()
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
                Forms\Components\TextInput::make('image_name')
                    ->required()
                    ->label('Pool Name')
                    ->hint('Insert name that suits the image.')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('image_description')
                    ->nullable()
                    ->label('Pool Details')
                    ->hint('Insert any information that suits the image.')
                    ->columnSpanFull(),
                Forms\Components\Select::make('image_tags')
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
                Forms\Components\Toggle::make('is_published')
                    ->label('Publish this Image?')
                    ->default(0),
                Forms\Components\TextInput::make('uploader_id')
                    ->default(Auth::id()) // Automatically set the current user's ID
                    ->label('Uploader ID')
                    ->hint('Ignore this field for validation purposes.')
                    ->readonly(),
            ]);
    }

    public static function table(Tables\Table $table): Tables\Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('image_path')
                    ->label('Image')
                    ->limit(1)
                    ->width(200)
                    ->height('auto'),
                Tables\Columns\TextColumn::make('image_name')
                    ->label('Pool Details')
                    ->description(fn(ImageGallery $record): string => $record->image_description)
                    ->wrap()
                    ->searchable(),
                Tables\Columns\TextColumn::make('image_tags')
                    ->label('Pool Tags')
                    ->badge()
                    ->separator(',')
                    ->wrap()
                    ->searchable(),
                Tables\Columns\IconColumn::make('is_published')
                    ->boolean()
                    ->label('Published'),
                Tables\Columns\TextColumn::make('created_at')
                    ->dateTime()
                    ->wrap()
                    ->label('Uploaded Date')
                    ->timezone('Asia/Kuala_Lumpur'),
            ])
            ->filters([
                Filter::make('is_published')
                    ->query(fn(Builder $query) => $query->where('is_published', true))
                    ->label('Published'),
                SelectFilter::make('image_tags')
                    ->attribute('image_tags')
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
                    ]),
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()->action(function ($record) {
                        // Delete associated image before deleting the record
                        if ($record->image_path) {
                            Storage::disk('public')->delete($record->image_path);
                        }
                        // Now delete the record itself
                        $record->delete();
                    }),
                ])
                ->button()
                ->label('Actions')
            ])
            ->bulkActions([
                Tables\Actions\BulkActionGroup::make([
                    Tables\Actions\DeleteBulkAction::make()->action(function (array $records) {
                        foreach ($records as $record) {
                            if ($record->image_path) {
                                Storage::disk('public')->delete($record->image_path);
                            }
                            $record->delete();
                        }
                    }),
                    Tables\Actions\BulkAction::make('Publish All')
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
            'index' => Pages\ListImageGalleries::route('/'),
            'create' => Pages\CreateImageGallery::route('/create'),
            'edit' => Pages\EditImageGallery::route('/{record}/edit'),
        ];
    }
}
