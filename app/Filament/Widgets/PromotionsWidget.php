<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\PromotionResource;
use App\Models\Promotion;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class PromotionsWidget extends Widget
{
    use HasWidgetShield;

    protected static ?int $sort = 5;

    protected string $view = 'filament.widgets.promotions-widget';

    /**
     * @return array{activePromotions: Collection<int, Promotion>, upcomingPromotions: Collection<int, Promotion>, createUrl: ?string}
     */
    protected function getViewData(): array
    {
        $now = now();

        return [
            'activePromotions' => Promotion::query()
                ->where('start_time', '<=', $now)
                ->where('end_time', '>=', $now)
                ->orderBy('end_time')
                ->get(),
            'upcomingPromotions' => Promotion::query()
                ->where('start_time', '>', $now)
                ->orderBy('start_time')
                ->get(),
            'createUrl' => PromotionResource::canCreate() ? PromotionResource::getUrl('create') : null,
        ];
    }
}
