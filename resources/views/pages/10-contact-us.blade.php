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
    ogImage="{{ asset('assets/images/'.$imageFileLoc) }}" />
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
                    <p class="text-sm text-neutral-500">Accept cookies to load the map.</p>
                </div>
            </template>
        </div>
    </section>

    <section id="showpool">
        <div class="flex justify-between items-start flex-col lg:flex-row gap-4 mb-8">
            <div>
                <x-reusables.pill-text>{{__('strings.contact_visit_showpool_pill')}}</x-reusables.pill-text>
                <x-reusables.subheading class="uppercase">{{__('strings.contact_visit_showpool_heading')}}
                </x-reusables.subheading>
                <p class="aquarius-visit-showpool-desc">{{__('strings.contact_visit_showpool_desc')}}</p>
            </div>
            <a href="{{ route('about-page') }}#showroom"
                class="group inline-flex items-center gap-1 text-secondary-800 hover:underline underline-offset-4 font-medium">
                {{__('strings.contact_visit_showpool_link')}}
                <svg class="w-5 h-5 transition-transform duration-200 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
            </a>
        </div>

        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8">
            <div class="aquarius-contact-card lg:col-span-full">
                <h3 class="aquarius-contact-card-title">{{__('strings.contact_showpool_address_title')}}</h3>
                <p class="text-lg font-semibold text-neutral-900! mb-2.5">AQUARIUS SWIMMING POOLS SDN BHD
                    &lpar;920548-M&rpar;</p>
                <p>33, Jalan Selatan 3/4, Taman Impian Emas,<br>81300 Skudai, Johor,<br> Malaysia</p>
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