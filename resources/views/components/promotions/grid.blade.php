@forelse($promotions as $promotion)
<div class="bg-white border border-neutral-200 rounded-lg p-6">

    {{-- Badge + title --}}
    <div class="flex flex-wrap items-start justify-between gap-3 mb-3">
        <h2 class="font-bold text-neutral-900 text-lg mt-0">{{ $promotion->title }}</h2>
        <span class="shrink-0 inline-flex items-center py-1 px-3 rounded-full text-base font-semibold bg-secondary-500 text-white">
            {{__('strings.promotions_current_promo_badge')}}
        </span>
    </div>

    {{-- Description --}}
    <p class="text-neutral-700 mb-3">{{ $promotion->description }}</p>

    {{-- Duration --}}
    <p class="text-base text-neutral-500 mb-4">
        <strong class="text-neutral-700">{{__('strings.promotions_current_promo_duration')}}: </strong>
        {{ $promotion->start_time->timezone('Asia/Kuala_Lumpur')->format('j F Y, g:i A') }}
        –
        {{ $promotion->end_time?->timezone('Asia/Kuala_Lumpur')->format('j F Y, g:i A') ?? __('strings.promotions_until_further_notice') }}
    </p>

    {{-- Image carousel --}}
    @php
        $images = collect($promotion->file_attachment ?? [])->filter(function ($file) {
            return in_array(strtolower(pathinfo($file, PATHINFO_EXTENSION)), ['jpg', 'jpeg', 'png', 'gif', 'bmp', 'svg', 'webp']);
        })->values();
    @endphp

    @if($images->isNotEmpty())
        <div class="promo-swiper swiper" data-promo-id="{{ $promotion->id }}">
            <div class="swiper-wrapper">
                @foreach($images as $file)
                    @php
                        $encodedFile = implode('/', array_map('rawurlencode', explode('/', 'promotion_materials/' . $file)));
                    @endphp
                    <div class="swiper-slide">
                        <a data-fslightbox="promotion_{{ $promotion->id }}" href="{{ asset('storage/' . $encodedFile) }}"
                           class="relative block w-full aspect-square overflow-hidden rounded-xl bg-neutral-100 transition-all duration-200 hover:outline-3 hover:-outline-offset-3 hover:outline-primary-600 active:scale-97">
                            {{-- Square frame, whole image shown: promotion posters carry prices and text that must not be cropped.
                                 A blurred copy of the same image fills any space around it instead of flat bars. --}}
                            <img src="{{ asset('storage/' . $encodedFile) }}"
                                 alt=""
                                 aria-hidden="true"
                                 loading="lazy"
                                 class="absolute inset-0 w-full h-full object-cover scale-110 blur-xl opacity-60">
                            <img src="{{ asset('storage/' . $encodedFile) }}"
                                 alt="{{ $promotion->title }}"
                                 loading="lazy"
                                 class="relative w-full h-full object-contain">
                        </a>
                    </div>
                @endforeach
            </div>
            <div class="swiper-pagination mt-2"></div>
            <div class="swiper-button-prev"></div>
            <div class="swiper-button-next"></div>
        </div>
    @endif
</div>
@empty
<div class="rounded-lg border border-neutral-200 bg-neutral-50 p-6 lg:p-8 text-center">
    <h2 class="text-2xl text-primary-900 font-semibold mb-3 mt-0">{{__('strings.promotions_no_active_promo_title')}}</h2>
    <p class="text-neutral-700 m-0">{{__('strings.promotions_no_active_promo_body')}}</p>
</div>
@endforelse
