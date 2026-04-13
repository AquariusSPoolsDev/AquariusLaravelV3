<x-filament-widgets::widget>
    <x-filament::section>
        <div class="">
            <h2 class="text-xl font-bold mb-2">Campaigns / Promotions</h2>
            <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                <div class="">
                    <h3 class="">Active Promotions</h3>
                    @php
                        $activePromotions = $this->getActivePromotions();
                    @endphp
                    @if ($activePromotions->isNotEmpty())
                        @foreach ($activePromotions as $promotion)
                            <div style="margin: 0.75rem 0" class="border border-gray-800 dark:border-gray-600 p-4 rounded-xl">
                                <h4 class="font-semibold mb-1 text-primary-600 dark:text-primary-400" style="font-size: 18px">{{ $promotion->title }}</h4>
                                <p class="text-sm text-gray-500 dark:text-gray-400">{{ $promotion->description }}</p>
                                <p class="mt-1 text-sm"><strong>Validity: </strong>{{ $promotion->start_time->timezone('Asia/Kuala_Lumpur')->format('d/m/Y H:i') }} until {{ $promotion->end_time->timezone('Asia/Kuala_Lumpur')->format('d/m/Y H:i') }}</p>
                            </div>
                        @endforeach
                    @else
                    <div style="margin: 0.75rem 0" class="border border-gray-800 dark:border-gray-600 p-4 rounded-xl">
                        <p class="text-sm text-gray-500 dark:text-gray-400">No active promotions at this time.</p>
                    </div>
                    @endif
                </div>

                <div class="">
                    <h3 class="">Upcoming Promotions</h3>
                    @php
                        $upcomingPromotions = $this->getUpcomingPromotions();
                    @endphp
                    @if ($upcomingPromotions->isNotEmpty())
                        @foreach ($upcomingPromotions as $promotion)
                        <div style="margin: 0.75rem 0" class="border border-gray-800 dark:border-gray-600 p-4 rounded-xl">
                            <h4 class="font-semibold mb-1 text-primary-600 dark:text-primary-400" style="font-size: 18px">{{ $promotion->title }}</h4>
                            <p class="text-sm text-gray-500 dark:text-gray-400">{{ $promotion->description }}</p>
                            <p class="mt-1 text-sm"><strong>Start Time: </strong>{{ $promotion->start_time->timezone('Asia/Kuala_Lumpur')->format('d/m/Y H:i') }} until {{ $promotion->end_time->timezone('Asia/Kuala_Lumpur')->format('d/m/Y H:i') }}</p>
                        </div>
                        @endforeach
                    @else
                    <div style="margin: 0.75rem 0" class="border border-gray-800 dark:border-gray-600 p-4 rounded-xl">
                        <p class="text-sm text-gray-500 dark:text-gray-400">No upcoming promotions at this time.</p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>