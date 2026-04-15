{{-- CONTACT PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.def-temp')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc   = 'pool-image-placeholder-2.jpg';
    $headerTitle    = 'contact_title_heading';
    $headerSubtitle = 'contact_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo 
        ogPageTitle="{{__('strings.' . $headerTitle)}}"
        ogDescription="{{__('strings.' . $headerSubtitle)}}"
        ogImage="{{ asset('assets/images/'.$imageFileLoc) }}"
    /> 
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
<div class="flex flex-col gap-y-20">
    <section class="flex flex-col lg:flex-row lg:justify-between">
        <div class="max-lg:mb-3 lg:w-[60%]">
            <p class="mb-8">{{__('strings.contact_fill_body')}}</p>
            <x-homepage.contact-form />
        </div>
        <div class="max-lg:mt-3 max-lg:h-96 lg:w-[35%]">
            <iframe width="100%" height="100%" class="rounded-xl border border-neutral-200" src="https://maps.google.com/maps?width=684&amp;height=440&amp;hl=en&amp;q=+(Aquarius%20Swimming%20Pools%20Sdn%20Bhd)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">Loading...</iframe>
        </div>
    </section>

    <section id="showpool" class="">
        <x-reusables.pill-text>{{__('strings.contact_visit_showpool_pill')}}</x-reusables.pill-text>
        <x-reusables.subheading class="uppercase">{{__('strings.contact_visit_showpool_heading')}}</x-reusables.subheading>
        <p class="aquarius-visit-showpool-desc">{{__('strings.contact_visit_showpool_desc')}}</p>
        
        <div class="grid grid-cols-1 md:grid-cols-2 gap-4 lg:gap-8">
            <div class="aquarius-contact-card lg:col-span-full">
                <h3 class="aquarius-contact-card-title">{{__('strings.contact_showpool_address_title')}}</h3>
                <p class="text-lg font-semibold text-neutral-900! mb-2.5">AQUARIUS SWIMMING POOLS SDN BHD &lpar;920548-M&rpar;</p>
                <p>33, Jalan Selatan 3/4, Taman Impian Emas,<br>81300 Skudai, Johor,<br> Malaysia</p>
            </div>
    
            <div class="aquarius-contact-card">
                <h3 class="aquarius-contact-card-title">{{__('strings.contact_business_hours_title')}}</h3>
                <p class="mb-2.5"><strong>{{__('strings.contact_mon_fri')}}:</strong><br>8:30 AM - 5:30 PM</p>
                <p class="mb-2.5"><strong>{{__('strings.contact_sat')}}:</strong><br>8:30AM - 12:30PM</p>
                <p><strong class="text-error!">{{__('strings.contact_close_sun')}}</strong></p>
            </div>
    
            <div class="aquarius-contact-card">
                <h3 class="aquarius-contact-card-title">{{__('strings.contact_our_team_title')}}</h3>
                <p class="mb-2.5"><strong>{{__('strings.contact_office')}}:</strong> <a href="tel:+6075953060" class="text-primary-600 hover:text-primary-700">+607 - 595 3060</a></p>
                <p class="mb-2.5"><strong>{{__('strings.contact_mobile')}}:</strong> +6012 - 510 5126 <i>&lpar;{{__('strings.contact_mobile_whatsapp')}}&rpar;</i></p>
                <p class="mb-2.5"><strong>{{__('strings.contact_email')}}:</strong> <a href="mailto:mail@aquariuspools.com.my" class="text-primary-600 hover:text-primary-700">mail@aquariuspools.com.my</a></p>
            </div>
        </div>
    </section>
</div>
@endsection