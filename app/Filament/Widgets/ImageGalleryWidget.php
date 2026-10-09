<?php

namespace App\Filament\Widgets;

use App\Filament\Resources\ImageGalleryResource;
use App\Models\ImageGallery;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;
use Filament\Widgets\Widget;
use Illuminate\Support\Collection;

class ImageGalleryWidget extends Widget
{
    use HasWidgetShield;

    protected static ?int $sort = 4;

    protected string $view = 'filament.widgets.image-gallery-widget';

    /**
     * @return array{recentImages: Collection<int, ImageGallery>, tagCounts: Collection<string, int>, visibleTagLimit: int, galleryUrl: string}
     */
    protected function getViewData(): array
    {
        $tagCounts = ImageGallery::query()
            ->get(['id', 'image_tags'])
            ->flatMap(fn (ImageGallery $image): array => $image->image_tags ?? [])
            ->countBy()
            ->sortDesc();

        return [
            'recentImages' => ImageGallery::query()->latest()->take(5)->get(['id', 'image_path', 'image_name', 'created_at']),
            'tagCounts' => $tagCounts,
            'visibleTagLimit' => 10,
            'galleryUrl' => ImageGalleryResource::getUrl('index'),
        ];
    }
}
