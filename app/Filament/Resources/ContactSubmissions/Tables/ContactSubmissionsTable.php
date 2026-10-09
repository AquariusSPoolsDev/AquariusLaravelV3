<?php

namespace App\Filament\Resources\ContactSubmissions\Tables;

use App\Models\ContactSubmission;
use Filament\Actions\Action;
use Filament\Actions\BulkAction;
use Filament\Actions\BulkActionGroup;
use Filament\Actions\DeleteBulkAction;
use Filament\Actions\ViewAction;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Filters\SelectFilter;
use Filament\Tables\Table;
use Illuminate\Database\Eloquent\Collection;

class ContactSubmissionsTable
{
    public static function configure(Table $table): Table
    {
        return $table
            ->defaultSort('created_at', 'desc')
            ->columns([
                TextColumn::make('name')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('email')
                    ->searchable()
                    ->sortable(),
                TextColumn::make('phone')
                    ->label('Phone')
                    ->state(fn ($record) => $record->country_code.' '.$record->phone)
                    ->searchable(),
                static::interestColumn(),
                static::statusColumn(),
                TextColumn::make('created_at')
                    ->label('Received')
                    ->dateTime('d M Y, g:i A')
                    ->timezone('Asia/Kuala_Lumpur')
                    ->sortable(),
            ])
            ->filters([
                SelectFilter::make('status')
                    ->options([
                        'new' => 'New',
                        'read' => 'Read',
                        'spam' => 'Spam',
                    ]),
            ])
            ->recordActions([
                static::whatsAppAction(),
                ViewAction::make()
                    ->beforeFormFilled(fn (ContactSubmission $record) => $record->markAsRead()),
            ])
            ->toolbarActions([
                BulkActionGroup::make([
                    BulkAction::make('markAsRead')
                        ->label('Mark as Read')
                        ->icon('heroicon-o-check-circle')
                        ->color('success')
                        ->action(fn (Collection $records) => $records->each->update(['status' => 'read']))
                        ->deselectRecordsAfterCompletion(),
                    BulkAction::make('markAsSpam')
                        ->label('Mark as Spam')
                        ->icon('heroicon-o-x-circle')
                        ->color('danger')
                        ->action(fn (Collection $records) => $records->each->update(['status' => 'spam']))
                        ->deselectRecordsAfterCompletion(),
                    DeleteBulkAction::make(),
                ]),
            ]);
    }

    /**
     * Interest column, appending the free-text "other" answer when given. Shared with the dashboard widget.
     */
    public static function interestColumn(): TextColumn
    {
        return TextColumn::make('interest')
            ->label('Interest')
            ->state(fn (ContactSubmission $record): string => $record->interest_other
                ? $record->interest.' — '.$record->interest_other
                : ($record->interest ?? '—'))
            ->wrap();
    }

    /**
     * Status badge column. Shared with the dashboard widget.
     */
    public static function statusColumn(): TextColumn
    {
        return TextColumn::make('status')
            ->badge()
            ->formatStateUsing(fn (string $state): string => ucfirst($state))
            ->color(fn (string $state): string => match ($state) {
                'new' => 'warning',
                'read' => 'success',
                'spam' => 'danger',
                default => 'gray',
            });
    }

    /**
     * Opens a WhatsApp chat with the enquirer. Shared with the dashboard widget.
     */
    public static function whatsAppAction(): Action
    {
        return Action::make('whatsapp')
            ->label('WhatsApp')
            ->icon('heroicon-o-chat-bubble-left-ellipsis')
            ->color('success')
            ->url(fn (ContactSubmission $record): string => 'https://wa.me/'.ltrim($record->country_code, '+').$record->phone)
            ->openUrlInNewTab();
    }
}
