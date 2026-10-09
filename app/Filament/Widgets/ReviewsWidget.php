<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\CustReviews\CustReviewResource;
use App\Models\CustReview;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class ReviewsWidget extends Widget
{
    use HasWidgetShield;

    protected static ?int $sort = 3;

    protected string $view = 'filament.widgets.reviews-widget';

    /**
     * @return array{platforms: Collection<int, object>, reviewCount: int, averageRating: ?float, latestReviews: Collection<int, CustReview>, manageUrl: string}
     */
    protected function getViewData(): array
    {
        $platforms = CustReview::query()
            ->toBase()
            ->selectRaw('source as platform, ROUND(AVG(rating), 1) as average, COUNT(*) as total')
            ->groupBy('source')
            ->orderByDesc('total')
            ->get();

        $reviewCount = (int) $platforms->sum('total');

        $platforms->each(function (object $platform) use ($reviewCount): void {
            $platform->share = $reviewCount > 0 ? round($platform->total / $reviewCount * 100, 1) : 0;
        });

        return [
            'platforms' => $platforms,
            'reviewCount' => $reviewCount,
            'averageRating' => $reviewCount > 0 ? $platforms->sum(fn (object $platform): float => $platform->average * $platform->total) / $reviewCount : null,
            'latestReviews' => CustReview::query()->latest('reviewed_at')->take(3)->get(),
            'manageUrl' => CustReviewResource::getUrl('index'),
        ];
    }
}
