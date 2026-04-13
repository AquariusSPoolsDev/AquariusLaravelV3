<?php

namespace App\Filament\Widgets;

use Filament\Widgets\Widget;
use App\Models\Promotion;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class PromotionsWidget extends Widget
{
    use HasWidgetShield;

    protected static string $view = 'filament.widgets.promotions-widget';
    protected int | string | array $columnSpan = 'full'; 
    
    public function getActivePromotions()
    {
        $now = now();
        
        return Promotion::where('start_time', '<=', $now)
            ->where('end_time', '>=', $now)
            ->orderBy('start_time', 'asc')
            ->get();
    }

    public function getUpcomingPromotions()
    {
        return Promotion::where('start_time', '>', now())
            ->orderBy('start_time', 'asc')
            ->get();
    }
}
