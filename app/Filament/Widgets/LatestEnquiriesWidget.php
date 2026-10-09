<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Filament\Resources\ContactSubmissions\Tables\ContactSubmissionsTable;
use App\Models\ContactSubmission;
use Filament\Actions\Action;
use Filament\Support\Enums\FontWeight;
use Filament\Support\Icons\Heroicon;
use Filament\Tables\Columns\TextColumn;
use Filament\Tables\Table;
use Filament\Widgets\TableWidget;
use Illuminate\Database\Eloquent\Builder;

class LatestEnquiriesWidget extends TableWidget
{
    protected static ?int $sort = 2;

    public static function canView(): bool
    {
        return ContactSubmissionResource::canViewAny();
    }

    public function table(Table $table): Table
    {
        return $table
            ->heading('Latest enquiries')
            ->description('Contact form submissions')
            ->query(fn (): Builder => ContactSubmission::query()->latest()->limit(5))
            ->paginated(false)
            ->columns([
                TextColumn::make('name')
                    ->weight(FontWeight::Bold),
                ContactSubmissionsTable::interestColumn(),
                TextColumn::make('created_at')
                    ->label('Received')
                    ->since()
                    ->timezone('Asia/Kuala_Lumpur')
                    ->dateTimeTooltip('d M Y, g:i A'),
                ContactSubmissionsTable::statusColumn(),
            ])
            ->headerActions([
                Action::make('viewAll')
                    ->label('View all')
                    ->link()
                    ->url(ContactSubmissionResource::getUrl('index')),
            ])
            ->recordActions([
                ContactSubmissionsTable::whatsAppAction(),
            ])
            ->emptyStateIcon(Heroicon::OutlinedInbox)
            ->emptyStateHeading('No enquiries yet');
    }
}
