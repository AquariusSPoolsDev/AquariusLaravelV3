{{-- CONTACT PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-contact-us.jpg';
$headerTitle = 'contact_display_heading';
$headerSubtitle = 'contact_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
<x-seo.seo ogPageTitle="{{__('strings.contact_title_heading')}}" ogDescription="{{__('strings.contact_meta_description')}}"
    ogImage="{{ asset('assets/images/pool_header/'.$imageFileLoc) }}" />
<x-seo.breadcrumb-schema :items="[
    ['name' => 'Contact Us', 'url' => route('contact-page')],
]" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
<div class="flex flex-col gap-y-20">
    <section class="grid grid-cols-1 lg:grid-cols-2 lg:gap-x-16">
        <div class="max-lg:mb-3 lg:col-span-1">
            <p class="mb-8">{{__('strings.contact_fill_body')}}</p>
            <x-reusables.contact-form />
        </div>
        <div class="max-lg:mt-3 max-lg:h-96 lg:col-span-1"
            x-data="{
                consent: null,
                init() {
                    this.consent = document.cookie.split(';').map(c => c.trim()).find(c => c.startsWith('aquarius_cookie_consent='))?.split('=')[1] || null;
                    document.addEventListener('cookie-accepted', () => { this.consent = 'accepted'; });
                }
            }">
            {{-- Map loads only after cookie consent --}}
            <template x-if="consent === 'accepted'">
                <iframe width="100%" height="100%" class="rounded-lg border border-neutral-200"
                    src="https://maps.google.com/maps?width=684&amp;height=440&amp;hl=en&amp;q=+(Aquarius%20Swimming%20Pools%20Sdn%20Bhd)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed"
                    frameborder="0" scrolling="no" marginheight="0" marginwidth="0">Loading...</iframe>
            </template>
            <template x-if="consent !== 'accepted'">
                <div class="w-full h-full min-h-64 rounded-lg border border-neutral-200 bg-neutral-50 flex flex-col items-center justify-center gap-3 text-center p-6">
                    <svg class="size-8 text-neutral-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M112,80a16,16,0,1,1,16,16A16,16,0,0,1,112,80ZM64,80a64,64,0,0,1,128,0c0,59.95-57.58,93.54-60,94.95a8,8,0,0,1-7.94,0C121.58,173.54,64,140,64,80Zm16,0c0,42.2,35.84,70.21,48,78.5,12.15-8.28,48-36.3,48-78.5a48,48,0,0,0-96,0Zm122.77,67.63a8,8,0,0,0-5.54,15C213.74,168.74,224,176.92,224,184c0,13.36-36.52,32-96,32s-96-18.64-96-32c0-7.08,10.26-15.26,26.77-21.36a8,8,0,0,0-5.54-15C29.22,156.49,16,169.41,16,184c0,31.18,57.71,48,112,48s112-16.82,112-48C240,169.41,226.78,156.49,202.77,147.63Z"></path></svg>
                    <p class="text-base text-neutral-600">Accept cookies to load the map.</p>
                </div>
            </template>
        </div>
    </section>

    <section id="showpool">
        <div class="flex justify-between items-start flex-col lg:flex-row gap-4 mb-8">
            <div>
                <x-reusables.subheading>{{__('strings.contact_visit_showpool_heading')}}
                </x-reusables.subheading>
                <div class="aquarius-visit-showpool-desc max-w-[60ch] space-y-3">
                    <p>{{__('strings.about_showroom_body_1')}}</p>
                    <p>{{__('strings.about_showroom_body_2')}}</p>
                </div>
            </div>
            @if (\App\Enums\SitePage::AboutUs->isVisible())
            <a href="{{ route('about-page') }}#showroom"
                class="group inline-flex items-center gap-1 text-secondary-800 hover:underline underline-offset-4 font-medium">
                {{__('strings.contact_visit_showpool_link')}}
                <svg class="w-5 h-5 transition-transform duration-200 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
            </a>
            @endif
        </div>

        {{--
            SHOWROOM PHOTOS (to fill in later)
            Each slot shows its photo once 'src' is set (a path under public/, e.g. 'assets/images/showroom/exterior.jpg').
            Until then, empty slots appear as labelled placeholders on local copies only (APP_DEBUG=true) and are
            left out entirely on the live site, so visitors never see an empty box.
        --}}
        @php
            $showroomPhotos = [
                ['src' => null, 'alt' => 'Aquarius Swimming Pools showroom, office and shop from the road', 'need' => 'Showroom exterior', 'hint' => 'Landscape, from the road, with the signboard readable', 'wide' => true],
                ['src' => null, 'alt' => 'Full-size concrete display pool at the Aquarius showroom', 'need' => 'Concrete display pool', 'hint' => 'Whole pool in frame, daylight'],
                ['src' => null, 'alt' => 'Full-size vinyl display pool at the Aquarius showroom', 'need' => 'Vinyl display pool', 'hint' => 'Whole pool in frame, daylight'],
                ['src' => null, 'alt' => 'Full-size fibreglass display pool at the Aquarius showroom', 'need' => 'Fibreglass display pool', 'hint' => 'Whole pool in frame, daylight'],
                ['src' => null, 'alt' => 'Inside the Aquarius pool shop and office', 'need' => 'Shop and office, inside', 'hint' => 'Counter and shelves, ideally with staff'],
            ];
            $showPhotoPlaceholders = config('app.debug');
            $visiblePhotos = array_filter($showroomPhotos, fn (array $photo): bool => $photo['src'] !== null || $showPhotoPlaceholders);
        @endphp

        @if ($visiblePhotos !== [])
        <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mb-8" data-showroom-photos>
            @foreach ($visiblePhotos as $photo)
                <figure class="{{ ! empty($photo['wide']) ? 'col-span-2 lg:row-span-2 aspect-video lg:aspect-auto' : 'aspect-4/3' }} m-0 overflow-hidden rounded-lg">
                    @if ($photo['src'])
                        <img src="{{ asset($photo['src']) }}" alt="{{ $photo['alt'] }}" loading="lazy" class="w-full h-full object-cover">
                    @else
                        <div class="w-full h-full min-h-32 flex flex-col items-center justify-center gap-1 p-4 text-center border-2 border-dashed border-neutral-300 bg-neutral-50 rounded-lg" data-photo-placeholder>
                            <span class="text-base font-semibold text-neutral-700">Photo needed: {{ $photo['need'] }}</span>
                            <span class="text-xs text-neutral-500">{{ $photo['hint'] }}</span>
                        </div>
                    @endif
                </figure>
            @endforeach
        </div>
        @endif

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8">
            <div class="aquarius-contact-card lg:col-span-full">
                <h3 class="aquarius-contact-card-title">{{__('strings.contact_showpool_address_title')}}</h3>
                <p class="text-lg font-semibold text-neutral-900! mb-2.5">AQUARIUS SWIMMING POOLS SDN BHD
                    &lpar;920548-M&rpar;</p>
                <p>33, Jalan Selatan 3/4, Taman Impian Emas,<br>81300 Skudai, Johor,<br> Malaysia</p>
                <a href="https://www.google.com/maps/dir/?api=1&amp;destination={{ urlencode('Aquarius Swimming Pools Sdn Bhd, 33 Jalan Selatan 3/4, Taman Impian Emas, 81300 Skudai, Johor') }}"
                    target="_blank" rel="noopener"
                    class="mt-4 inline-flex items-center gap-2 py-2.5 px-5 rounded-lg bg-primary-700 text-white font-semibold hover:bg-primary-800 active:bg-primary-900"
                    onclick="window.dataLayer=window.dataLayer||[];window.dataLayer.push({event:'get_directions_click',location:'contact_showroom'})">
                    <svg class="size-5 shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor" aria-hidden="true"><path d="M128,64a40,40,0,1,0,40,40A40,40,0,0,0,128,64Zm0,64a24,24,0,1,1,24-24A24,24,0,0,1,128,128Zm0-112a88.1,88.1,0,0,0-88,88c0,31.4,14.51,64.68,42,96.25a254.19,254.19,0,0,0,41.45,38.3,8,8,0,0,0,9.18,0A254.19,254.19,0,0,0,174,200.25c27.45-31.57,42-64.85,42-96.25A88.1,88.1,0,0,0,128,16Zm0,206c-16.53-13-72-60.75-72-118a72,72,0,0,1,144,0C200,161.23,144.53,209,128,222Z"></path></svg>
                    {{ __('strings.contact_get_directions') }}
                    <span class="sr-only">{{ __('strings.navbar_opens_new_tab') }}</span>
                </a>
            </div>

            <div class="aquarius-contact-card">
                <h3 class="aquarius-contact-card-title">{{__('strings.contact_business_hours_title')}}</h3>
                <p class="mb-2.5"><strong>{{__('strings.contact_mon_fri')}}:</strong><br>8:00 AM - 5:00 PM</p>
                <p class="mb-2.5"><strong>{{__('strings.contact_sat')}}:</strong><br>8:00 AM - 12:00 PM</p>
                <p><strong class="text-error-400!">{{__('strings.contact_close_sun')}}</strong></p>
            </div>

            <div class="aquarius-contact-card">
                <h3 class="aquarius-contact-card-title">{{__('strings.contact_our_team_title')}}</h3>
                <p class="mb-2.5"><strong>{{__('strings.contact_office')}}:</strong> <a href="tel:+6075953060"
                        class="text-primary-600 underline underline-offset-4 hover:text-primary-700 active:text-primary-700 hover:no-underline active:no-underline">+607 - 595 3060</a></p>
                <p class="mb-2.5"><strong>{{__('strings.contact_mobile')}}:</strong> <a href="https://wa.me/60125105126" target="_blank"
                        class="text-primary-600 underline underline-offset-4 hover:text-primary-700 active:text-primary-700 hover:no-underline active:no-underline">+6012 - 510 5126</a>
                    <i>&lpar;{{__('strings.contact_mobile_whatsapp')}}&rpar;</i></p>
                <p class="mb-2.5"><strong>{{__('strings.contact_email')}}:</strong> <a
                        href="mailto:mail@aquariuspools.com.my"
                        class="text-primary-600 underline underline-offset-4 hover:text-primary-700 active:text-primary-700 hover:no-underline active:no-underline">mail@aquariuspools.com.my</a></p>
            </div>
        </div>
    </section>
</div>
@endsection