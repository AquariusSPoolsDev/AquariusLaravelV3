<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages\CreatePromotion;
use App\Filament\Resources\PromotionResource\Pages\EditPromotion;
use App\Filament\Resources\PromotionResource\Pages\ListPromotions;
use App\Models\Promotion;
use Filament\Actions\ActionGroup;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteAction;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\EditAction;
use Filament\Actions\ViewAction;
use Filament\Forms\Components\DateTimePicker;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\Textarea;
use Filament\Forms\Components\TextInput;
use Filament\Resources\Resource;
use Filament\Schemas\Schema;
use Filament\Tables\Columns\ImageColumn;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\Storage;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    protected static string|\BackedEnum|null $navigationIcon = 'heroicon-o-megaphone';

    protected static ?string $navigationLabel = 'Promotions';

    protected static string|\UnitEnum|null $navigationGroup = 'Content Management';

    public static function getNavigationBadge(): ?string
    {
        return Promotion::where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->get()
            ->count();
    }

    protected static string|\Illuminate\Contracts\Support\Htmlable|null $navigationBadgeTooltip = 'Active Promotions';

    public static function form(Schema $schema): Schema
    {
        return $schema
            ->components([
                TextInput::make('title')
                    ->required()
                    ->label('Promotion Title')
                    ->hint('Your Promotion Name.')
                    ->columnSpanFull(),
                Textarea::make('description')
                    ->required()
                    ->hint('Your Promotion Details.')
                    ->label('Promotion Details')
                    ->columnSpanFull(),
                DateTimePicker::make('start_time')
                    ->required()
                    ->hint('Promotion start time.')
                    ->label('Start Time')
                    ->seconds(false)
                    ->native(false)
                    ->live()
                    ->timezone('Asia/Kuala_Lumpur'),
                DateTimePicker::make('end_time')
                    ->nullable()
                    ->hint('Promotion end time. Must be latter time.')
                    ->label('End Time')
                    ->seconds(false)
                    ->native(false)
                    ->timezone('Asia/Kuala_Lumpur')
                    ->after('start_time'),
                FileUpload::make('file_attachment')
                    ->label('Promotional Materials')
                    ->hint('Your Promotion material images. Can be uploaded multiple files. Max 2MB each.')
                    ->nullable()
                    ->disk('public')
                    ->visibility('public')
                    ->directory('promotion_materials')
                    ->image()
                    ->acceptedFileTypes(['image/jpeg', 'image/png', 'image/gif', 'image/webp'])
                    ->multiple()
                    ->columnSpanFull()
                    ->preserveFilenames()
                    ->panelLayout('grid')
                    ->reorderable()
                    ->appendFiles()
                    ->afterStateHydrated(function (FileUpload $component, $state): void {
                        if (is_array($state)) {
                            $component->state(array_map(
                                fn (string $path) => str_starts_with($path, 'promotion_materials/') ? $path : 'promotion_materials/'.$path,
                                $state
                            ));
                        }
                    })
                    ->maxSize(2048),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                ImageColumn::make('file_attachment')
                    ->label('Image')
                    ->disk('public')
                    ->state(fn (Promotion $record): string => 'promotion_materials/'.($record->file_attachment[0] ?? ''))
                    ->limit(1)
                    ->width(150)
                    ->height('auto')
                    ->extraImgAttributes(['style' => 'border-radius: 0.25rem; width: 150px; height: auto; object-fit: cover;']),
                TextColumn::make('title')
                    ->label('Promotion Details')
                    ->description(fn (Promotion $record): string => $record->description)
                    ->wrap(),
                TextColumn::make('start_time')
                    ->label('Promo Starts')
                    ->wrap()
                    ->dateTime()
                    ->timezone('Asia/Kuala_Lumpur'),
                TextColumn::make('end_time')
                    ->label('Promo Ends')
                    ->wrap()
                    ->dateTime()
                    ->timezone('Asia/Kuala_Lumpur'),
                TextColumn::make('uploader.name')
                    ->label('Uploaded By')
                    ->wrap(),
            ])
            ->filters([
                //
            ])
            ->recordActions([
                ActionGroup::make([
                    ViewAction::make(),
                    EditAction::make(),
                    DeleteAction::make()->action(function (Promotion $record) {
                        // Delete associated files before deleting the record
                        if ($record->file_attachment) {
                            foreach ($record->file_attachment as $filePath) {
                                Storage::disk('public')->delete('promotion_materials/'.$filePath);
                            }
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
                    DeleteBulkAction::make()->action(function (Collection $records) {
                        foreach ($records as $record) {
                            // Check if there are file attachments and delete them
                            if ($record->file_attachment) {
                                foreach ($record->file_attachment as $filePath) {
                                    Storage::disk('public')->delete('promotion_materials/'.$filePath);
                                }
                            }
                            // Now delete the record itself
                            $record->delete();
                        }
                    }),
                ]),
            ])
            ->defaultSort('start_time', 'desc');
    }

    public static function getPages(): array
    {
        return [
            'index' => ListPromotions::route('/'),
            'create' => CreatePromotion::route('/create'),
            'edit' => EditPromotion::route('/{record}/edit'),
        ];
    }
}
