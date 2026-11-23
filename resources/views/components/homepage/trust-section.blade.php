{{-- A2: Homepage Trust / About Us Section --}}
{{-- Desktop: text left, image right. Mobile: stacked. --}}
{{-- Showroom images: swap placeholders with real photos post-photoshoot --}}

<section id="about">
    <div class="main-container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-start">

            {{-- LEFT: Text content --}}
            <div class="max-w-xl">
                <h2 class="text-section font-semibold text-balance text-primary-900">{{__('strings.trust_heading')}}</h2>
                <p class="text-neutral-600 mt-6 mb-8">{{__('strings.trust_body')}}</p>

                {{-- Numbers and MSPA membership, plain (no boxes) --}}
                <div class="grid grid-cols-2 max-w-sm" data-trust-stats>
                    <p class="pr-4 sm:pr-8 border-r border-neutral-200">
                        <span class="block font-heading text-4xl font-bold text-primary-700" data-counter="30" data-suffix="+">30+</span>
                        <span class="text-neutral-600">{{__('strings.trust_stats_years')}}</span>
                    </p>
                    <p class="pl-4 sm:pl-8">
                        <span class="block font-heading text-4xl font-bold text-primary-700" data-counter="1000" data-suffix="+" data-format="thousands">1,000+</span>
                        <span class="text-neutral-600">{{__('strings.trust_stats_pools')}}</span>
                    </p>
                </div>

                <div class="mt-8 pt-8 border-t border-neutral-200 flex items-center gap-4">
                    <img src="{{ asset('assets/images/homepage/mspa-logo.png') }}" alt="Logo of Malaysian Swimming Pool Association" class="h-14 w-auto shrink-0">
                    <p class="text-neutral-600">{{__('strings.trust_member_of')}}
                        <span class="block font-semibold text-neutral-900">Malaysian Swimming Pool Association</span>
                    </p>
                </div>

            </div>

            {{-- RIGHT: showroom photos, then the address, hours and directions. Photos link to the showroom section on the Contact page (plain photos if that page is switched off) --}}
            @php
                $showroomHref = \App\Enums\SitePage::ContactUs->isVisible() ? route('contact-page').'#showpool' : null;
                $showroomTag = $showroomHref ? 'a' : 'div';
            @endphp
            <div>
            <div class="flex flex-col gap-4" data-animate data-delay="200">
                {{-- Large: showroom exterior --}}
                <{{ $showroomTag }} @if ($showroomHref) href="{{ $showroomHref }}" @endif class="group/img block relative overflow-hidden rounded-xl bg-neutral-100 aspect-video border-2 border-neutral-200 transition-all duration-200 hover:outline-3 hover:-outline-offset-3 hover:outline-primary-600 active:scale-97"><span class="sr-only">{{ __('strings.navbar_visit_showroom') }}: </span>
                    <picture>
                        <source srcset="{{ asset('assets/images/homepage/aquarius-showroom-exterior.webp') }}" type="image/webp">
                        <img loading="lazy" src="{{ asset('assets/images/homepage/aquarius-showroom-exterior.jpg') }}" alt="The Aquarius showroom, office and shop in Skudai, from the road" class="w-full h-full object-cover">
                    </picture>
                </{{ $showroomTag }}>
                {{-- Three smaller: pool type displays (swipe on mobile with a position bar, grid on desktop) --}}
                <div x-data="{ thumb: 60, offset: 0 }"
                    x-init="const strip = $refs.strip; const update = () => { const max = strip.scrollWidth - strip.clientWidth; thumb = max > 0 ? strip.clientWidth / strip.scrollWidth * 100 : 100; offset = max > 0 ? strip.scrollLeft / max * (100 - thumb) : 0; }; update(); strip.addEventListener('scroll', update, { passive: true }); window.addEventListener('resize', update);">
                <div x-ref="strip" class="flex gap-4 overflow-x-auto snap-x snap-mandatory [scrollbar-width:none] [&::-webkit-scrollbar]:hidden lg:grid lg:grid-cols-3 lg:overflow-visible">
                    <{{ $showroomTag }} @if ($showroomHref) href="{{ $showroomHref }}" @endif class="group/img block relative shrink-0 snap-start w-[60vw] sm:w-[45vw] lg:w-auto overflow-hidden rounded-xl bg-neutral-100 aspect-4/3 border-2 border-neutral-200 transition-all duration-200 hover:outline-3 hover:-outline-offset-3 hover:outline-primary-600 active:scale-97"><span class="sr-only">{{ __('strings.navbar_visit_showroom') }}: </span>
                        <picture>
                            <source srcset="{{ asset('assets/images/homepage/aquarius-showroom-concrete.webp') }}" type="image/webp">
                            <img loading="lazy" src="{{ asset('assets/images/homepage/aquarius-showroom-concrete.jpg') }}" alt="Concrete display pool at the Aquarius showroom" class="w-full h-full object-cover">
                        </picture>
                    </{{ $showroomTag }}>
                    <{{ $showroomTag }} @if ($showroomHref) href="{{ $showroomHref }}" @endif class="group/img block relative shrink-0 snap-start w-[60vw] sm:w-[45vw] lg:w-auto overflow-hidden rounded-xl bg-neutral-100 aspect-4/3 border-2 border-neutral-200 transition-all duration-200 hover:outline-3 hover:-outline-offset-3 hover:outline-primary-600 active:scale-97"><span class="sr-only">{{ __('strings.navbar_visit_showroom') }}: </span>
                        <picture>
                            <source srcset="{{ asset('assets/images/homepage/aquarius-showroom-vinyl.webp') }}" type="image/webp">
                            <img loading="lazy" src="{{ asset('assets/images/homepage/aquarius-showroom-vinyl.jpg') }}" alt="Vinyl display pool at the Aquarius showroom" class="w-full h-full object-cover">
                        </picture>
                    </{{ $showroomTag }}>
                    <{{ $showroomTag }} @if ($showroomHref) href="{{ $showroomHref }}" @endif class="group/img block relative shrink-0 snap-start w-[60vw] sm:w-[45vw] lg:w-auto overflow-hidden rounded-xl bg-neutral-100 aspect-4/3 border-2 border-neutral-200 transition-all duration-200 hover:outline-3 hover:-outline-offset-3 hover:outline-primary-600 active:scale-97"><span class="sr-only">{{ __('strings.navbar_visit_showroom') }}: </span>
                        <picture>
                            <source srcset="{{ asset('assets/images/homepage/aquarius-showroom-fibreglass.webp') }}" type="image/webp">
                            <img loading="lazy" src="{{ asset('assets/images/homepage/aquarius-showroom-fibreglass.jpg') }}" alt="Fibreglass display pool at the Aquarius showroom" class="w-full h-full object-cover">
                        </picture>
                    </{{ $showroomTag }}>
                </div>
                <div class="lg:hidden relative mx-auto mt-4 h-1.5 w-24 rounded-full bg-neutral-200" aria-hidden="true" data-strip-indicator>
                    <div class="absolute inset-y-0 rounded-full bg-primary-600" :style="`width: ${thumb}%; left: ${offset}%`" style="width: 60%; left: 0"></div>
                </div>
                </div>
            </div>

            {{-- Showroom details: same address and hours as the Contact page --}}
            <div class="mt-8" data-showroom-details>
                <h3 class="text-xl lg:text-2xl font-semibold text-primary-900">{{ __('strings.contact_visit_showpool_heading') }}</h3>
                <div class="mt-4 grid grid-cols-1 sm:grid-cols-[auto_auto] sm:justify-start gap-x-12 gap-y-4 text-neutral-600">
                    <address class="not-italic">33, Jalan Selatan 3/4,<br>Taman Impian Emas,<br>81300 Skudai, Johor</address>
                    <div>
                        <dl>
                            <div><dt class="inline font-semibold text-neutral-800">{{ __('strings.contact_mon_fri') }}:</dt> <dd class="inline whitespace-nowrap">8:00 AM - 5:00 PM</dd></div>
                            <div><dt class="inline font-semibold text-neutral-800">{{ __('strings.contact_sat') }}:</dt> <dd class="inline whitespace-nowrap">8:00 AM - 12:00 PM</dd></div>
                        </dl>
                        <p>{{ __('strings.contact_close_sun') }}</p>
                    </div>
                </div>
                <div class="mt-6 flex flex-wrap items-center gap-x-6 gap-y-3">
                    <a href="https://www.google.com/maps/dir/?api=1&amp;destination={{ urlencode('Aquarius Swimming Pools Sdn Bhd, 33 Jalan Selatan 3/4, Taman Impian Emas, 81300 Skudai, Johor') }}"
                        target="_blank" rel="noopener"
                        class="inline-flex items-center gap-2 py-2.5 px-5 rounded-lg bg-primary-700 text-white font-semibold hover:bg-primary-800 active:bg-primary-900 max-w-full"
                        onclick="window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:'get_directions_click',location:'homepage_showroom'})">
                        <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor" aria-hidden="true"><path d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z"></path></svg>
                        {{ __('strings.contact_get_directions') }}
                        <span class="sr-only">{{ __('strings.navbar_opens_new_tab') }}</span>
                    </a>
                    @if ($showroomHref)
                    <a href="{{ $showroomHref }}" class="group text-primary-700 font-semibold underline-offset-4 hover:underline active:underline">
                        {{ __('strings.trust_showroom_more') }}&nbsp;<svg class="inline-block size-5 align-[-0.25em] transition-transform duration-200 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor" aria-hidden="true"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
                    </a>
                    @endif
                </div>
            </div>
            </div>

        </div>
    </div>
</section>
