<x-filament-widgets::widget>
    <x-filament::section>
        <div>
            <h2 class="text-xl font-bold mb-2">Campaigns / Promotions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div>
                    <h3 class="font-semibold text-lg mb-1">Active Promotions</h3>
                    @php $activePromotions = $this->getActivePromotions(); @endphp
                    @if ($activePromotions->isNotEmpty())
                        @foreach ($activePromotions as $promotion)
                        <div class="my-3 border border-success-200 bg-success-100 p-4 rounded-xl">
                            <h4 class="font-semibold mb-1 text-success-400 text-lg">{{ $promotion->title }}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $promotion->description }}</p>
                            <p class="mt-1 text-sm"><strong>Validity: </strong>{{ $promotion->start_time->timezone('Asia/Kuala_Lumpur')->format('d/m/Y H:i') }} until {{ $promotion->end_time->timezone('Asia/Kuala_Lumpur')->format('d/m/Y H:i') }}</p>
                        </div>
                        @endforeach
                    @else
                    <div class="my-3 border border-gray-200 dark:border-gray-600 p-4 rounded-xl">
                        <p class="text-sm text-gray-500 dark:text-gray-400">No active promotions at this time.</p>
                    </div>
                    @endif
                </div>

                <div>
                    <h3 class="font-semibold text-lg mb-1">Upcoming Promotions</h3>
                    @php $upcomingPromotions = $this->getUpcomingPromotions(); @endphp
                    @if ($upcomingPromotions->isNotEmpty())
                        @foreach ($upcomingPromotions as $promotion)
                        <div class="my-3 border border-warning-200 bg-warning-100 p-4 rounded-xl">
                            <h4 class="font-semibold mb-1 text-warning-400 text-lg">{{ $promotion->title }}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $promotion->description }}</p>
                            <p class="mt-1 text-sm"><strong>Start Time: </strong>{{ $promotion->start_time->timezone('Asia/Kuala_Lumpur')->format('d/m/Y H:i') }} until {{ $promotion->end_time->timezone('Asia/Kuala_Lumpur')->format('d/m/Y H:i') }}</p>
                        </div>
                        @endforeach
                    @else
                    <div class="my-3 border border-gray-200 dark:border-gray-600 p-4 rounded-xl">
                        <p class="text-sm text-gray-500 dark:text-gray-400">No upcoming promotions at this time.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
