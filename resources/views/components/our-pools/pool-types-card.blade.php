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
                        <svg class="size-4 transition-transform group-hover/link:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
                    </a>
                @endif
            </div>
        </div>
    </div>
</div>
{{-- CARD --}}