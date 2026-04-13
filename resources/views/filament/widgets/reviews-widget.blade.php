<x-filament-widgets::widget>
    <x-filament::section>
        <div>
            <h2 class="text-xl font-bold mb-2">Reviews</h2>
            
            <div class="mb-4 mt-2">
                <h3 class="font-semibold text-lg" style="margin-bottom: 0.25rem">Stats</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div class="">
                        <h4 class="text-gray-500 dark:text-gray-400 text-sm">Total Reviews</h4>
                        <p style="font-size: 2.25rem" class="font-semibold text-primary-600 dark:text-primary-400">{{ $this->getTotalReviews() }}</p>
                    </div>

                    <div class="">
                        <h4 class="text-gray-500 dark:text-gray-400 text-sm">Average Rating</h4>
                        <p style="font-size: 2.25rem" class="font-semibold text-primary-600 dark:text-primary-400">{{ $this->getAverageRating() ? number_format($this->getAverageRating(), 1) : 'No ratings yet' }}</p>
                    </div>
                </div>
            </div>
        
            <div class="">
                <h3 class="font-semibold text-lg" style="margin-bottom: 0.25rem">Latest Reviews</h3>
                <style>
                    @media (min-width: 1024px) {
                        .lg-col {
                            grid-template-columns: repeat(5, minmax(0, 1fr));
                        }
                    }
                </style>
                <div class="grid grid-cols-1 md:grid-cols-3 lg-col gap-4 mt-2">
                    @foreach ($this->getLatestReviews() as $review)
                    <div style="margin: 0.75rem 0" class="border border-gray-800 dark:border-gray-600 p-4 rounded-xl">
                        <div class="flex justify-between">
                            <div>
                                <h5 class="font-bold">{{ $review->reviewer_name }}</h5>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $review->reviewer_location }}</p>                                
                            </div>
                            <div>{{ $review->rating }} ⭐</div>
                        </div>
                        <div style="margin-top: 1rem">{!! $review->review !!}</div>
                    </div>
                    @endforeach
                </div>

                @if ($this->getLatestReviews()->isEmpty())
                <div style="margin: 0.75rem 0" class="border border-gray-800 dark:border-gray-600 p-4 rounded-xl">
                    <p class="text-sm text-gray-500 dark:text-gray-400">No reviews available.</p>
                </div>
                @endif
            </div>
        
            
        </div>        
    </x-filament::section>
</x-filament-widgets::widget>
