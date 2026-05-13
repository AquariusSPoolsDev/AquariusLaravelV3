<?php

namespace App\Enums;

class PoolTags
{
    public static function translationKey(string $tag): string
    {
        return strtolower(str_replace(' ', '_', $tag));
    }

    public static function translate(string $tag): string
    {
        return __('strings.'.self::translationKey($tag));
    }

    public static function options(): array
    {
        return [
            'Concrete' => 'Concrete',
            'Vinyl' => 'Vinyl',
            'Fibreglass' => 'Fibreglass',
            'Skimmer' => 'Skimmer',
            'Overflow' => 'Overflow',
            'Infinity' => 'Infinity',
            'Residential Pool' => 'Residential Pool',
            'Commercial Pool' => 'Commercial Pool',
            'Balinese' => 'Balinese',
            'Lampang' => 'Lampang',
            'Customised Tiling' => 'Customised Tiling',
            'Jacuzzi' => 'Jacuzzi',
            'Heated Pool' => 'Heated Pool',
            'Kids Pool' => 'Kids Pool',
            'Lightweight Panel Pool' => 'Lightweight Panel Pool',
            'Timber Deck' => 'Timber Deck',
            'Concrete Deck' => 'Concrete Deck',
            'Water Features' => 'Water Features',
            'Waterfall' => 'Waterfall',
            'Nature' => 'Nature',
            'Water Fountain' => 'Water Fountain',
            'Oasis' => 'Oasis',
            'Luxurious' => 'Luxurious',
            'Landscape Design' => 'Landscape Design',
            'Wading Pool' => 'Wading Pool',
            'Private Pool' => 'Private Pool',
            'Contemporary' => 'Contemporary',
            'Swimming Pool' => 'Swimming Pool',
            'Gazebos' => 'Gazebos',
            'Minimalism' => 'Minimalism',
            'LED Lights' => 'LED Lights',
            'Fitness' => 'Fitness',
            'Backyard' => 'Backyard',
            'Mosaic Tiles' => 'Mosaic Tiles',
            'Safety Fence' => 'Safety Fence',
        ];
    }
}
