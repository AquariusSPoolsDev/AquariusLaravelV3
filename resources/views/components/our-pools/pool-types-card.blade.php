@props(['pool_type_image', 'pool_type_name', 'pool_type_desc', 'pool_type_route' => null])

{{-- CARD --}}
<div class="aquarius-our-pools-card">
    <div class="aquarius-our-pools-card-content">
        <img loading="lazy" class="aquarius-our-pools-card-img"
            src="{{$pool_type_image}}" alt="{{$pool_type_name}} Image">

        <div class="aquarius-our-pools-card-body">
            <div class="flex flex-col justify-center">
                <h3 class="our-pools-type-title">
                    {{$pool_type_name}}
                </h3>
                <p class="mb-0">
                    {{$pool_type_desc}}
                </p>
                @if($pool_type_route)
                    <a href="{{ $pool_type_route }}"
                        class="mt-4 inline-flex items-center gap-2 text-sm font-semibold text-primary-700 hover:text-primary-900 transition-colors group/link">
                        {{ __('strings.our_pools_learn_more') }}
                        <svg class="size-4 transition-transform group-hover/link:translate-x-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M5 12h14M12 5l7 7-7 7"/></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- CARD --}}