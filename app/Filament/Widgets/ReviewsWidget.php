<?php

namespace App\Filament\Widgets;

use App\Models\CustReview;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class ReviewsWidget extends Widget
{
    use HasWidgetShield;

    protected string $view = 'filament.widgets.reviews-widget';

    protected int|string|array $columnSpan = 'full';

    public function getTotalReviews(): int
    {
        return CustReview::query()->count('id');
    }

    public function getAverageRating(): ?float
    {
        return CustReview::query()->avg('rating');
    }

    public function getAverageRatingByPlatform(): Collection
    {
        return CustReview::query()
            ->selectRaw('source as platform, ROUND(AVG(rating), 1) as average, COUNT(*) as total')
            ->groupBy('source')
            ->orderByDesc('total')
            ->get();
    }

    public function getLatestReviews(): Collection
    {
        return CustReview::query()->orderBy('reviewed_at', 'desc')->take(5)->get();
    }
}
