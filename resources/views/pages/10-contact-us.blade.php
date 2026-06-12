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
                    <svg class="size-8 text-neutral-400" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="1.5"><path stroke-linecap="round" stroke-linejoin="round" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z"/><path stroke-linecap="round" stroke-linejoin="round" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z"/></svg>
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
                <svg class="w-5 h-5 transition-transform duration-200 group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
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