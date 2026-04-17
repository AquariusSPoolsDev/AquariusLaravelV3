<x-filament-widgets::widget>
    <x-filament::section>
        <div>
            <h2 class="text-xl font-bold mb-2">Reviews</h2>

            <div class="mb-4 mt-2">
                <h3 class="font-semibold text-lg mb-1">Stats</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <div>
                        <h4 class="text-gray-500 dark:text-gray-400 text-sm">Total Reviews</h4>
                        <p class="text-4xl font-semibold text-primary-600 dark:text-primary-400">{{ $this->getTotalReviews() }}</p>
                    </div>

                    <div>
                        <h4 class="text-gray-500 dark:text-gray-400 text-sm">Average Rating</h4>
                        <p class="text-4xl font-semibold text-primary-600 dark:text-primary-400">{{ $this->getAverageRating() ? number_format($this->getAverageRating(), 1) : 'No ratings yet' }}</p>
                    </div>
                </div>
            </div>

            <div>
                <h3 class="font-semibold text-lg mb-1">Latest Reviews</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-2">
                    @foreach ($this->getLatestReviews() as $review)
                    <div class="my-3 border border-gray-200 dark:border-gray-600 p-4 rounded-xl">
                        <div class="flex justify-between">
                            <div>
                                <h5 class="font-bold">{{ $review->reviewer_name }}</h5>
                                <p class="text-gray-500 dark:text-gray-400 text-sm">{{ $review->reviewer_location }}</p>
                            </div>
                            <div>{{ $review->rating }} ⭐</div>
                        </div>
                        <div class="mt-4">{!! $review->review !!}</div>
                    </div>
                    @endforeach
                </div>

                @if ($this->getLatestReviews()->isEmpty())
                <div class="my-3 border border-gray-200 dark:border-gray-600 p-4 rounded-xl">
                    <p class="text-sm text-gray-500 dark:text-gray-400">No reviews available.</p>
                </div>
                @endif
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
