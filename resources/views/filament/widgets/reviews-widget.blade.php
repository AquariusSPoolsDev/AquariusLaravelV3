<x-filament-widgets::widget>
    <x-filament::section
        heading="Reviews"
        :description="$reviewCount > 0 ? $reviewCount . ' ' . Str::plural('review', $reviewCount) . ' · ' . number_format($averageRating, 1) . ' average' : 'No reviews yet'"
    >
        <x-slot name="afterHeader">
            <x-filament::link :href="$manageUrl" size="sm">Manage</x-filament::link>
        </x-slot>

        <div class="flex flex-col gap-6">
            @if ($platforms->isNotEmpty())
                <div class="flex flex-col gap-3">
                    @foreach ($platforms as $platform)
                        <div class="flex flex-col gap-1.5">
                            <div class="flex justify-between gap-2 text-sm">
                                <span class="font-semibold text-gray-950 dark:text-white">{{ $platform->platform ?? 'Unknown' }}</span>
                                <span class="text-gray-500 dark:text-gray-400">
                                    <strong class="text-gray-950 dark:text-white">{{ $platform->average }}</strong>
                                    · {{ $platform->total }} {{ Str::plural('review', $platform->total) }}
                                </span>
                            </div>
                            <div class="h-2 overflow-hidden rounded-full bg-gray-100 dark:bg-white/10">
                                <div class="h-2 rounded-full bg-primary-600 dark:bg-primary-500" style="width: {{ $platform->share }}%"></div>
                            </div>
                        </div>
                    @endforeach
                </div>
            @endif

            <div class="flex flex-col divide-y divide-gray-100 dark:divide-white/10">
                @forelse ($latestReviews as $review)
                    <div class="flex flex-col gap-1 py-3 first:pt-0 last:pb-0">
                        <div class="flex items-center justify-between gap-2">
                            <span class="font-semibold text-gray-950 dark:text-white">{{ $review->reviewer_name }}</span>
                            <span class="flex items-center gap-0.5" aria-label="{{ $review->rating }} out of 5 stars">
                                @for ($star = 1; $star <= 5; $star++)
                                    <x-filament::icon
                                        :icon="$star <= $review->rating ? 'heroicon-s-star' : 'heroicon-o-star'"
                                        class="size-4 text-warning-500"
                                    />
                                @endfor
                            </span>
                        </div>
                        <span class="text-xs text-gray-500 dark:text-gray-400">
                            {{ collect([$review->source, $review->reviewer_location, $review->reviewed_at?->format('d M Y')])->filter()->implode(' · ') }}
                        </span>
                        <p class="line-clamp-2 text-sm text-gray-600 dark:text-gray-300">{{ Str::limit(strip_tags($review->review), 200) }}</p>
                    </div>
                @empty
                    <p class="text-sm text-gray-500 dark:text-gray-400">No reviews available.</p>
                @endforelse
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
