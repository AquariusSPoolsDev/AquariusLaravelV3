<x-filament-widgets::widget>
    <x-filament::section heading="Promotions" description="Active and upcoming campaigns">
        @if ($activePromotions->isEmpty() && $upcomingPromotions->isEmpty())
            <div class="flex flex-col items-center gap-3 py-6 text-center">
                <div class="flex size-12 items-center justify-center rounded-full bg-gray-100 dark:bg-white/10">
                    <x-filament::icon icon="heroicon-o-megaphone" class="size-6 text-gray-500 dark:text-gray-400" />
                </div>
                <div>
                    <p class="font-semibold text-gray-950 dark:text-white">No active or upcoming promotions</p>
                    <p class="mt-1 text-sm text-gray-500 dark:text-gray-400">The promo banner on the website stays hidden until one is live.</p>
                </div>
                @if ($createUrl)
                    <x-filament::button tag="a" :href="$createUrl" size="sm">Create promotion</x-filament::button>
                @endif
            </div>
        @else
            <div class="flex flex-col gap-3">
                @foreach ([['Active', 'success', $activePromotions], ['Upcoming', 'warning', $upcomingPromotions]] as [$label, $color, $promotions])
                    @foreach ($promotions as $promotion)
                        <div class="flex flex-col gap-1 rounded-lg border border-gray-200 p-3 dark:border-white/10">
                            <div class="flex items-start justify-between gap-2">
                                <span class="font-semibold text-gray-950 dark:text-white">{{ $promotion->title }}</span>
                                <x-filament::badge :color="$color">{{ $label }}</x-filament::badge>
                            </div>
                            <p class="line-clamp-2 text-sm text-gray-600 dark:text-gray-300">{{ $promotion->description }}</p>
                            <p class="text-xs text-gray-500 dark:text-gray-400">
                                {{ $promotion->start_time->timezone('Asia/Kuala_Lumpur')->format('d M Y, g:i A') }}
                                – {{ $promotion->end_time?->timezone('Asia/Kuala_Lumpur')->format('d M Y, g:i A') ?? 'no end date' }}
                            </p>
                        </div>
                    @endforeach
                @endforeach
            </div>
        @endif
    </x-filament::section>
</x-filament-widgets::widget>
