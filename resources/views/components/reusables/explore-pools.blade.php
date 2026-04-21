@props(['current'])

{{-- EXPLORE OTHER POOL TYPES --}}
<section class="mt-16">
    <x-reusables.pill-text>{{ __('strings.explore_pools_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.explore_pools_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">

        {{-- CONCRETE --}}
        @if ($current === 'concrete')
            <div class="pro-con-card p-0! overflow-hidden opacity-50 cursor-default select-none hover:translate-y-0! hover:border-neutral-200! hover:shadow-none!">
                <div class="flex lg:flex-col">
                    <div class="w-32 lg:w-full lg:h-48 shrink-0">
                        <img src="{{ asset('assets/images/pool_types/pool-type-concrete.jpg') }}" alt="{{ __('strings.pools_concrete') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 lg:p-6 flex flex-col justify-center">
                        <h3 class="pro-con-card-title">{{ __('strings.pools_concrete') }}</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">{{ __('strings.explore_pools_concrete_desc') }}</p>
                        <span class="text-sm lg:text-base font-semibold text-neutral-400">{{ __('strings.explore_pools_current_page') }}</span>
                    </div>
                </div>
            </div>
        @else
            <a href="{{ route('concrete-pools-page') }}" class="pro-con-card p-0! overflow-hidden block group active:scale-97! active:border-primary!">
                <div class="flex lg:flex-col">
                    <div class="w-32 lg:w-full lg:h-48 shrink-0">
                        <img src="{{ asset('assets/images/pool_types/pool-type-concrete.jpg') }}" alt="{{ __('strings.pools_concrete') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 lg:p-6 flex flex-col justify-center">
                        <h3 class="pro-con-card-title">{{ __('strings.pools_concrete') }}</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">{{ __('strings.explore_pools_concrete_desc') }}</p>
                        <span class="text-sm lg:text-base font-semibold text-primary-700 group-hover:underline">{{ __('strings.explore_pools_learn_more') }} &rarr;</span>
                    </div>
                </div>
            </a>
        @endif

        {{-- VINYL --}}
        @if ($current === 'vinyl')
            <div class="pro-con-card p-0! overflow-hidden opacity-50 cursor-default select-none hover:translate-y-0! hover:border-neutral-200! hover:shadow-none!">
                <div class="flex lg:flex-col">
                    <div class="w-32 lg:w-full lg:h-48 shrink-0">
                        <img src="{{ asset('assets/images/pool_types/pool-type-vinyl.jpg') }}" alt="{{ __('strings.pools_vinyl') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 lg:p-6 flex flex-col justify-center">
                        <h3 class="pro-con-card-title">{{ __('strings.pools_vinyl') }}</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">{{ __('strings.explore_pools_vinyl_desc') }}</p>
                        <span class="text-sm lg:text-base font-semibold text-neutral-400">{{ __('strings.explore_pools_current_page') }}</span>
                    </div>
                </div>
            </div>
        @else
            <a href="{{ route('vinyl-pools-page') }}" class="pro-con-card p-0! overflow-hidden block group active:scale-97! active:border-primary!">
                <div class="flex lg:flex-col">
                    <div class="w-32 lg:w-full lg:h-48 shrink-0">
                        <img src="{{ asset('assets/images/pool_types/pool-type-vinyl.jpg') }}" alt="{{ __('strings.pools_vinyl') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 lg:p-6 flex flex-col justify-center">
                        <h3 class="pro-con-card-title">{{ __('strings.pools_vinyl') }}</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">{{ __('strings.explore_pools_vinyl_desc') }}</p>
                        <span class="text-sm lg:text-base font-semibold text-primary-700 group-hover:underline">{{ __('strings.explore_pools_learn_more') }} &rarr;</span>
                    </div>
                </div>
            </a>
        @endif

        {{-- FIBREGLASS --}}
        @if ($current === 'fibreglass')
            <div class="pro-con-card p-0! overflow-hidden opacity-50 cursor-default select-none hover:translate-y-0! hover:border-neutral-200! hover:shadow-none!">
                <div class="flex lg:flex-col">
                    <div class="w-32 lg:w-full lg:h-48 shrink-0">
                        <img src="{{ asset('assets/images/pool_types/pool-type-fibreglass.jpg') }}" alt="{{ __('strings.pools_fibreglass') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 lg:p-6 flex flex-col justify-center">
                        <h3 class="pro-con-card-title">{{ __('strings.pools_fibreglass') }}</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">{{ __('strings.explore_pools_fibreglass_desc') }}</p>
                        <span class="text-sm lg:text-base font-semibold text-neutral-400">{{ __('strings.explore_pools_current_page') }}</span>
                    </div>
                </div>
            </div>
        @else
            <a href="{{ route('fibreglass-pools-page') }}" class="pro-con-card p-0! overflow-hidden block group active:scale-97! active:border-primary!">
                <div class="flex lg:flex-col">
                    <div class="w-32 lg:w-full lg:h-48 shrink-0">
                        <img src="{{ asset('assets/images/pool_types/pool-type-fibreglass.jpg') }}" alt="{{ __('strings.pools_fibreglass') }}" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 lg:p-6 flex flex-col justify-center">
                        <h3 class="pro-con-card-title">{{ __('strings.pools_fibreglass') }}</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">{{ __('strings.explore_pools_fibreglass_desc') }}</p>
                        <span class="text-sm lg:text-base font-semibold text-primary-700 group-hover:underline">{{ __('strings.explore_pools_learn_more') }} &rarr;</span>
                    </div>
                </div>
            </a>
        @endif

    </div>
</section>
