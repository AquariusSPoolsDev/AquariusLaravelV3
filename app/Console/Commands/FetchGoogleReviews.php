<?php

namespace App\Console\Commands;

use App\Models\GoogleReview;
use Illuminate\Console\Command;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\Http;

class FetchGoogleReviews extends Command
{
    protected $signature = 'app:fetch-google-reviews';

    protected $description = 'Fetch and cache Google Place reviews from the Places API';

    public function handle(): int
    {
        $apiKey = config('services.google.places_api_key');
        $placeId = config('services.google.place_id');

        $response = Http::withoutVerifying()->get('https://places.googleapis.com/v1/places/'.$placeId, [
            'key' => $apiKey,
            'fields' => 'reviews',
            'languageCode' => 'en',
        ]);

        if ($response->failed()) {
            $this->error('Failed to fetch reviews: '.$response->body());

            return self::FAILURE;
        }

        $reviews = $response->json('reviews', []);

        if (empty($reviews)) {
            $this->warn('No reviews returned from API.');

            return self::SUCCESS;
        }

        GoogleReview::truncate();

        foreach ($reviews as $review) {
            GoogleReview::create([
                'author_name' => data_get($review, 'authorAttribution.displayName', 'Anonymous'),
                'author_photo_url' => data_get($review, 'authorAttribution.photoUri'),
                'author_url' => data_get($review, 'authorAttribution.uri'),
                'rating' => data_get($review, 'rating', 0),
                'text' => data_get($review, 'text.text'),
                'relative_time_description' => data_get($review, 'relativePublishTimeDescription'),
                'published_at' => isset($review['publishTime']) ? Carbon::parse($review['publishTime']) : null,
            ]);
        }

        $this->info('Fetched '.count($reviews).' reviews successfully.');

        return self::SUCCESS;
    }
}
