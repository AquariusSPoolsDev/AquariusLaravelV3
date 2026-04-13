<?php

namespace App\Filament\Widgets;

use App\Models\ImageGallery;
use Filament\Widgets\Widget;
use Illuminate\Support\Facades\DB;
use BezhanSalleh\FilamentShield\Traits\HasWidgetShield;

class ImageGalleryWidget extends Widget
{
    use HasWidgetShield;
    protected static string $view = 'filament.widgets.image-gallery-widget';
    protected int | string | array $columnSpan = 'full'; 

    public function getImagesCount()
    {
        return ImageGallery::count();
    }

    public function getRecentImages()
    {
        return ImageGallery::orderBy('created_at', 'desc')->take(5)->get();
    }

    public function getPublishedImages(){
        return ImageGallery::where('is_published', true)->count();
    }

    public function getUnpublishedImages(){
        return ImageGallery::where('is_published', false)->count();
    }

    public function getTagsCount()
    {
        return DB::table('image_galleries')
            ->selectRaw('tag, COUNT(*) AS count')
            ->from(DB::raw('(SELECT jt.tag FROM image_galleries, JSON_TABLE(image_tags, \'$[*]\' COLUMNS (tag VARCHAR(255) PATH \'$\')) AS jt) AS tags'))
            ->groupBy('tag')
            ->orderBy('count', 'DESC')
            ->get();
    }

}
