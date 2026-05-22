@forelse($promotions as $promotion)
<div class="bg-white border border-neutral-200 rounded-lg p-6 transition-all duration-300 hover:-translate-y-1 hover:border-primary-300 hover:shadow-lg hover:shadow-primary-100">

    {{-- Badge + title --}}
    <div class="flex flex-wrap items-start justify-between gap-3 mb-3">
        <h2 class="font-bold text-neutral-900 text-lg mt-0">{{ $promotion->title }}</h2>
        <span class="shrink-0 inline-flex items-center py-1 px-3 rounded-full text-xs font-medium bg-secondary-100 text-secondary-800">
            {{__('strings.promotions_current_promo_badge')}}
        </span>
    </div>

    {{-- Description --}}
    <p class="text-neutral-700 mb-3">{{ $promotion->description }}</p>

    {{-- Duration --}}
    <p class="text-sm text-neutral-500 mb-4">
        <strong class="text-neutral-700">{{__('strings.promotions_current_promo_duration')}}: </strong>
        {{ $promotion->start_time->timezone('Asia/Kuala_Lumpur')->format('j F Y, g:i A') }}
        –
        {{ $promotion->end_time->timezone('Asia/Kuala_Lumpur')->format('j F Y, g:i A') }}
    </p>

    {{-- Image carousel --}}
    @php
        $images = collect($promotion->file_attachment ?? [])->filter(function ($file) {
            return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp']);
        })->values();
    @endphp

    @if($images->isNotEmpty())
        <div class="promo-swiper swiper rounded-xl overflow-hidden" data-promo-id="{{ $promotion->id }}">
            <div class="swiper-wrapper">
                @foreach($images as $file)
                    @php
                        $encodedFile = implode('/', array_map('rawurlencode', explode('/', 'promotion_materials/' . $file)));
                    @endphp
                    <div class="swiper-slide">
                        <a data-fslightbox="promotion_{{ $promotion->id }}" href="{{ asset('storage/' . $encodedFile) }}">
                            <img src="{{ asset('storage/' . $encodedFile) }}"
                                 alt="{{ $promotion->title }}"
                                 class="w-full h-64 object-cover">
                        </a>
                    </div>
                @endforeach
            </div>
            @if($images->count() > 1)
                <div class="swiper-pagination"></div>
                <div class="swiper-button-prev"></div>
                <div class="swiper-button-next"></div>
            @endif
        </div>
    @endif
</div>
@empty
<div class="bg-red-50 border-s-4 border-red-500 rounded-e-xl p-6 ps-8" role="alert">
    <h2 class="text-2xl text-neutral-900 font-semibold mb-3 mt-0">{{__('strings.promotions_no_active_promo_title')}}</h2>
    <p class="text-neutral-700 m-0">{{__('strings.promotions_no_active_promo_body')}}</p>
</div>
@endforelse
