<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Review;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class ReviewsWidget extends Widget
{
    use HasWidgetShield;

    protected static string $view = 'filament.widgets.reviews-widget';
    protected int | string | array $columnSpan = 'full'; 
    
    public function getTotalReviews()
    {
        // Count total reviews
        return Review::count();
    }

    public function getAverageRating()
    {
        // Calculate average rating from reviews
        return Review::average('rating'); // This returns null if there are no reviews
    }

    public function getLatestReviews()
    {
        // Fetch latest reviews (e.g., the last 5 reviews)
        return Review::orderBy('created_at', 'desc')->take(5)->get();
    }
}
