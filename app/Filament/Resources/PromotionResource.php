<?php

namespace App\Filament\Resources;

use App\Filament\Resources\PromotionResource\Pages;
use App\Filament\Resources\PromotionResource\RelationManagers;
use App\Models\Promotion;
use Filament\Forms;
use Filament\Forms\Form;
use Filament\Resources\Resource;
use Filament\Tables;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\SoftDeletingScope;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Illuminate\Database\Eloquent\Collection;

class PromotionResource extends Resource
{
    protected static ?string $model = Promotion::class;

    protected static ?string $navigationIcon = 'heroicon-o-megaphone';
    protected static ?string $navigationLabel = 'Promotions';
    protected static ?string $navigationGroup = 'Content Management';

    public static function getNavigationBadge(): ?string
    {
        return Promotion::where('start_time', '<=', now())
            ->where('end_time', '>=', now())
            ->orderBy('start_time', 'asc')
            ->get()
            ->count();
    }

    protected static ?string $navigationBadgeTooltip = 'Active Promotions';

    public static function form(Form $form): Form
    {
        return $form
            ->schema([
                Forms\Components\TextInput::make('title')
                    ->required()
                    ->label('Promotion Title')
                    ->hint('Your Promotion Name.')
                    ->columnSpanFull(),
                Forms\Components\Textarea::make('description')
                    ->required()
                    ->hint('Your Promotion Details.')
                    ->label('Promotion Details')
                    ->columnSpanFull(),
                Forms\Components\DateTimePicker::make('start_time')
                    ->required()
                    ->hint('Promotion start time.')
                    ->label('Start Time')
                    ->seconds(false)
                    ->native(false)
                    ->timezone('Asia/Kuala_Lumpur'),
                Forms\Components\DateTimePicker::make('end_time')
                    ->nullable()
                    ->hint('Promotion end time. Must be latter time.')
                    ->label('End Time')
                    ->seconds(false)
                    ->native(false)
                    ->timezone('Asia/Kuala_Lumpur'),
                Forms\Components\FileUpload::make('file_attachment')
                    ->label('Promotional Materials')
                    ->hint('Your Promotion material images. Can be uploaded multiple files. Max 2MB each.')
                    ->nullable()
                    ->directory('promotion_materials')
                    ->multiple()
                    ->columnSpanFull()
                    ->preserveFilenames()
                    ->panelLayout('grid')
                    ->reorderable()
                    ->appendFiles()
                    ->maxSize(2048),
                Forms\Components\TextInput::make('uploader_id')
                    ->default(Auth::id()) // Automatically set the current user's ID
                    ->label('Uploader ID (Ignore this part)')
                    ->hint('Ignore this field. Used for verification purposes.')
                    ->readonly(),
            ]);
    }

    public static function table(Table $table): Table
    {
        return $table
            ->columns([
                Tables\Columns\ImageColumn::make('file_attachment')
                    ->label('Image')
                    ->limit(1)
                    ->width(150)
                    ->height('auto'),
                Tables\Columns\TextColumn::make('title')
                    ->label('Promotion Details')
                    ->description(fn(Promotion $record): string => $record->description)
                    ->wrap(),
                Tables\Columns\TextColumn::make('start_time')
                    ->label('Promo Starts')
                    ->wrap()
                    ->dateTime()
                    ->timezone('Asia/Kuala_Lumpur'),
                Tables\Columns\TextColumn::make('end_time')
                    ->label('Promo Ends')
                    ->wrap()
                    ->dateTime()
                    ->timezone('Asia/Kuala_Lumpur'),
            ])
            ->filters([
                //
            ])
            ->actions([
                Tables\Actions\ActionGroup::make([
                    Tables\Actions\ViewAction::make(),
                    Tables\Actions\EditAction::make(),
                    Tables\Actions\DeleteAction::make()->action(function (Promotion $record) {
                        // Delete associated files before deleting the record
                        if ($record->file_attachment) {
                            foreach ($record->file_attachment as $filePath) {
                                Storage::disk('public')->delete($filePath);
                            }
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
                    Tables\Actions\DeleteBulkAction::make()->action(function (Collection $records) {
                        foreach ($records as $record) {
                            // Check if there are file attachments and delete them
                            if ($record->file_attachment) {
                                foreach ($record->file_attachment as $filePath) {
                                    Storage::disk('public')->delete($filePath);
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
            'index' => Pages\ListPromotions::route('/'),
            'create' => Pages\CreatePromotion::route('/create'),
            'edit' => Pages\EditPromotion::route('/{record}/edit'),
        ];
    }
}
