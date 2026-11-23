@props(['current'])

@php
    $pools = [
        'concrete' => ['route' => 'concrete-pools-page', 'image' => 'pool-type-concrete.jpg'],
        'vinyl' => ['route' => 'vinyl-pools-page', 'image' => 'pool-type-vinyl.jpg'],
        'fibreglass' => ['route' => 'fibreglass-pools-page', 'image' => 'pool-type-fibreglass.jpg'],
    ];
@endphp

{{-- EXPLORE OTHER POOL TYPES. The card for the page you are on is not a link: grey background and a "you are here" label, text kept at full contrast --}}
<section class="mt-16">
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.explore_pools_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-6">
        @foreach ($pools as $pool => $details)
            @php $isCurrent = $current === $pool; @endphp
            <{{ $isCurrent ? 'div' : 'a' }}
                @if ($isCurrent) aria-current="page" data-current-pool @else href="{{ route($details['route']) }}" @endif
                class="pro-con-card p-0! overflow-hidden block {{ $isCurrent ? 'bg-neutral-50! cursor-default hover:translate-y-0! hover:border-neutral-200! hover:shadow-none!' : 'group active:scale-97! active:border-primary!' }}">
                <div class="flex lg:flex-col">
                    <div class="w-32 lg:w-full lg:h-48 shrink-0">
                        <img loading="lazy" decoding="async" src="{{ asset('assets/images/pool_types/'.$details['image']) }}" alt="" class="w-full h-full object-cover">
                    </div>
                    <div class="p-4 lg:p-6 flex flex-col justify-center">
                        <h3 class="pro-con-card-title">{{ __('strings.pools_'.$pool) }}</h3>
                        <p class="text-neutral-600 leading-relaxed mb-4">{{ __('strings.explore_pools_'.$pool.'_desc') }}</p>
                        @if ($isCurrent)
                            <span class="inline-flex items-center gap-2 text-base font-semibold text-neutral-700">
                                <span class="size-2 rounded-full bg-primary-600" aria-hidden="true"></span>
                                {{ __('strings.explore_pools_current_page') }}
                            </span>
                        @else
                            <span class="text-base font-semibold text-primary-700 group-hover:underline">{{ __('strings.explore_pools_learn_more') }} <span aria-hidden="true">&rarr;</span></span>
                        @endif
                    </div>
                </div>
            </{{ $isCurrent ? 'div' : 'a' }}>
        @endforeach
    </div>
</section>
