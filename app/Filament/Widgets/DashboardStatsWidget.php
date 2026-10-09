<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ContactSubmissions\ContactSubmissionResource;
use App\Filament\Resources\CustReviews\CustReviewResource;
use App\Filament\Resources\ImageGalleryResource;
use App\Filament\Resources\PromotionResource;
use App\Models\ContactSubmission;
use App\Models\CustReview;
use App\Models\ImageGallery;
use App\Models\Promotion;
use Filament\Support\Icons\Heroicon;
use Filament\Widgets\StatsOverviewWidget;
use Filament\Widgets\StatsOverviewWidget\Stat;

class DashboardStatsWidget extends StatsOverviewWidget
{
    protected static ?int $sort = 1;

    protected ?string $pollingInterval = null;

    public static function canView(): bool
    {
        return ContactSubmissionResource::canViewAny()
            || CustReviewResource::canViewAny()
            || ImageGalleryResource::canViewAny()
            || PromotionResource::canViewAny();
    }

    /**
     * Each stat is only shown when the user may open the resource it links to.
     *
     * @return array<Stat>
     */
    protected function getStats(): array
    {
        return array_values(array_filter([
            ContactSubmissionResource::canViewAny() ? $this->enquiriesStat() : null,
            CustReviewResource::canViewAny() ? $this->reviewsStat() : null,
            ImageGalleryResource::canViewAny() ? $this->galleryStat() : null,
            PromotionResource::canViewAny() ? $this->promotionsStat() : null,
        ]));
    }

    protected function enquiriesStat(): Stat
    {
        $counts = ContactSubmission::query()
            ->toBase()
            ->selectRaw('COUNT(*) as total')
            ->selectRaw("SUM(CASE WHEN status = 'new' THEN 1 ELSE 0 END) as new_count")
            ->first();

        $newCount = (int) $counts->new_count;

        return Stat::make('New enquiries', $newCount)
            ->icon(Heroicon::OutlinedEnvelope)
            ->description($newCount > 0 ? "Awaiting reply · {$counts->total} total" : "All caught up · {$counts->total} total")
            ->descriptionIcon($newCount > 0 ? Heroicon::OutlinedClock : Heroicon::OutlinedCheckCircle)
            ->color($newCount > 0 ? 'warning' : 'success')
            ->url(ContactSubmissionResource::getUrl('index'));
    }

    protected function reviewsStat(): Stat
    {
        $summary = CustReview::query()
            ->toBase()
            ->selectRaw('COUNT(*) as total, AVG(rating) as average')
            ->first();

        return Stat::make('Average rating', $summary->total > 0 ? number_format((float) $summary->average, 1).' / 5' : '—')
            ->icon(Heroicon::OutlinedStar)
            ->description("From {$summary->total} reviews")
            ->color('gray')
            ->url(CustReviewResource::getUrl('index'));
    }

    protected function galleryStat(): Stat
    {
        $counts = ImageGallery::query()
            ->toBase()
            ->selectRaw('COUNT(*) as total')
            ->selectRaw('SUM(CASE WHEN is_published = 0 THEN 1 ELSE 0 END) as unpublished_count')
            ->first();

        $unpublishedCount = (int) $counts->unpublished_count;

        return Stat::make('Gallery images', $counts->total)
            ->icon(Heroicon::OutlinedPhoto)
            ->description($unpublishedCount > 0 ? "{$unpublishedCount} unpublished — please review" : 'All images published')
            ->descriptionIcon($unpublishedCount > 0 ? Heroicon::OutlinedExclamationTriangle : Heroicon::OutlinedCheckCircle)
            ->color($unpublishedCount > 0 ? 'danger' : 'success')
            ->url(ImageGalleryResource::getUrl('index'));
    }

    protected function promotionsStat(): Stat
    {
        $activeCount = Promotion::query()->active()->count();
        $upcomingCount = Promotion::query()->upcoming()->count();

        return Stat::make('Active promotions', $activeCount)
            ->icon(Heroicon::OutlinedMegaphone)
            ->description($upcomingCount > 0 ? "{$upcomingCount} upcoming" : 'None scheduled')
            ->color($activeCount > 0 ? 'success' : 'gray')
            ->url(PromotionResource::getUrl('index'));
    }
}
