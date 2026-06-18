{{-- A2: Homepage Trust / About Us Section --}}
{{-- Desktop: text left, image right. Mobile: stacked. --}}
{{-- Showroom images: swap placeholders with real photos post-photoshoot --}}

<section id="about">
    <div class="main-container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- LEFT: Text content --}}
            <div class="max-w-xl">
                <x-reusables.pill-text data-animate data-delay="0">{{__('strings.trust_pill')}}</x-reusables.pill-text>
                <h2 class="text-3xl lg:text-5xl font-semibold text-primary-900 font-serif" data-animate data-delay="100">{{__('strings.trust_heading')}}</h2>
                <p class="text-neutral-600 mt-6 mb-8" data-animate data-delay="200">{{__('strings.trust_body')}}</p>

                {{-- Stats bar --}}
                <div class="grid grid-cols-2 gap-6" data-animate data-delay="300">

                    {{-- Stat 1 --}}
                    <div class="bg-white border border-neutral-200 rounded-xl p-4">
                        <span class="block text-3xl font-bold text-primary-700" data-counter="30" data-suffix="+">30+</span>
                        <span class="text-sm text-neutral-600">{{__('strings.trust_stats_years')}}</span>
                    </div>

                    {{-- Stat 2 --}}
                    <div class="bg-white border border-neutral-200 rounded-xl p-4">
                        <span class="block text-3xl font-bold text-primary-700" data-counter="1000" data-suffix="+" data-format="thousands">1,000+</span>
                        <span class="text-sm text-neutral-600">{{__('strings.trust_stats_pools')}}</span>
                    </div>

                    {{-- Stat 3 --}}
                    <div class="col-span-2 bg-white border border-neutral-200 rounded-xl p-4">
                        <div class="flex items-center gap-4">
                            <div class="shrink-0">
                                <img src="{{ asset('assets/images/homepage/mspa-logo.png') }}" alt="Logo of Malaysian Swimming Pool Association" class="h-14 w-auto">
                            </div>
                            <div>
                                <span class="block text-xs text-neutral-500 uppercase tracking-wide">{{__('strings.trust_member_of')}}</span>
                                <span class="font-semibold text-neutral-800">Malaysian Swimming Pool Association</span>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mt-8" data-animate data-delay="400">
                    <a href="{{ route('about-page') }}"
                        class="inline-flex items-center gap-3 px-10 py-4 rounded-lg border border-primary-600 text-primary-700 font-semibold text-base lg:text-lg hover:bg-primary-50 hover:-translate-y-0.5 hover:shadow-lg hover:shadow-primary-100 active:scale-95 active:translate-y-0 transition-all duration-200">
                        {{ __('strings.trust_btn_about') }}
                        <svg class="size-5 transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
                    </a>
                </div>
            </div>

            {{-- RIGHT: Image grid --}}
            <div class="flex flex-col gap-4" data-animate data-delay="200">
                {{-- Large: showroom exterior --}}
                <div class="group/img overflow-hidden rounded-xl bg-neutral-100 aspect-video border-2 border-neutral-200 shadow-sm hover:border-primary-600 hover:shadow-lg transition-all duration-300 cursor-pointer">
                    <picture>
                        <source srcset="{{ asset('assets/images/homepage/aquarius-showroom-exterior.webp') }}" type="image/webp">
                        <img loading="lazy" src="{{ asset('assets/images/homepage/aquarius-showroom-exterior.jpg') }}" alt="Aquarius Pools Exterior Showroom" title="Aquarius Pools Exterior Showroom" class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-105">
                    </picture>
                </div>
                {{-- Three smaller: pool type displays (scroll on mobile, grid on desktop) --}}
                <div class="flex gap-4 overflow-x-auto pb-1 lg:grid lg:grid-cols-3 lg:overflow-visible lg:pb-0">
                    <div class="group/img shrink-0 w-[60vw] sm:w-[45vw] lg:w-auto overflow-hidden rounded-xl bg-neutral-100 aspect-4/3 border-2 border-neutral-200 shadow-sm hover:border-primary-600 hover:shadow-lg transition-all duration-300 cursor-pointer">
                        <picture>
                            <source srcset="{{ asset('assets/images/homepage/aquarius-showroom-concrete.webp') }}" type="image/webp">
                            <img loading="lazy" src="{{ asset('assets/images/homepage/aquarius-showroom-concrete.jpg') }}" alt="Concrete Pool Example Showroom" title="Concrete Pool Example Showroom" class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-105">
                        </picture>
                    </div>
                    <div class="group/img shrink-0 w-[60vw] sm:w-[45vw] lg:w-auto overflow-hidden rounded-xl bg-neutral-100 aspect-4/3 border-2 border-neutral-200 shadow-sm hover:border-primary-600 hover:shadow-lg transition-all duration-300 cursor-pointer">
                        <picture>
                            <source srcset="{{ asset('assets/images/homepage/aquarius-showroom-vinyl.webp') }}" type="image/webp">
                            <img loading="lazy" src="{{ asset('assets/images/homepage/aquarius-showroom-vinyl.jpg') }}" alt="Vinyl Pool Example Showroom" title="Vinyl Pool Example Showroom" class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-105">
                        </picture>
                    </div>
                    <div class="group/img shrink-0 w-[60vw] sm:w-[45vw] lg:w-auto overflow-hidden rounded-xl bg-neutral-100 aspect-4/3 border-2 border-neutral-200 shadow-sm hover:border-primary-600 hover:shadow-lg transition-all duration-300 cursor-pointer">
                        <picture>
                            <source srcset="{{ asset('assets/images/homepage/aquarius-showroom-fibreglass.webp') }}" type="image/webp">
                            <img loading="lazy" src="{{ asset('assets/images/homepage/aquarius-showroom-fibreglass.jpg') }}" alt="Fibreglass Pool Example Showroom" title="Fibreglass Pool Example Showroom" class="w-full h-full object-cover transition-transform duration-500 group-hover/img:scale-105">
                        </picture>
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
