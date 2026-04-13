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
<div class="mb-16">
    <section class="flex flex-col lg:flex-row lg:justify-between">
        <div class="max-lg:mb-3 lg:w-[60%]">
            <p class="mb-8">{{__('strings.contact_fill_body')}}</p>
            <x-homepage.contact-form />
        </div>
        <div class="max-lg:mt-3 max-lg:h-96 lg:w-[35%]">
            <iframe width="100%" height="100%" class="rounded-xl shadow-sm border border-gray-200" src="https://maps.google.com/maps?width=684&amp;height=440&amp;hl=en&amp;q=+(Aquarius%20Swimming%20Pools%20Sdn%20Bhd)&amp;ie=UTF8&amp;t=&amp;z=15&amp;iwloc=B&amp;output=embed" frameborder="0" scrolling="no" marginheight="0" marginwidth="0">Loading...</iframe>
        </div>
    </section>

    <div class="mt-16">
        <h2 class="text-3xl mb-4 font-bold uppercase text-center">{{__('strings.contact_visit_showpool_heading')}}</h2>
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4 lg:gap-8 text-gray-800">
            <div class="aquarius-contact-card">
                <h3 class="text-2xl uppercase font-semibold mb-3 text-primary-800">{{__('strings.contact_showpool_address_title')}}</h3>
                <p class="text-lg font-semibold">AQUARIUS SWIMMING POOLS SDN BHD<br>&lpar;920548-M&rpar;</p>
                <p>33, Jalan Selatan 3/4, Taman Impian Emas,<br>81300 Skudai, Johor,<br> Malaysia</p>
            </div>
    
            <div class="aquarius-contact-card">
                <h3 class="text-2xl uppercase font-semibold mb-3 text-primary-800">{{__('strings.contact_business_hours_title')}}</h3>
                <p class="mb-2"><strong>{{__('strings.contact_mon_fri')}}:</strong><br>8:30 AM - 5:30 PM</p>
                <p class="mb-2"><strong>{{__('strings.contact_sat')}}:</strong><br>8:30AM - 12:30PM</p>
                <p class="text-red-800"><strong>{{__('strings.contact_close_sun')}}</strong></p>
            </div>
    
            <div class="aquarius-contact-card">
                <h3 class="text-2xl uppercase font-semibold mb-3 text-primary-800">{{__('strings.contact_our_team_title')}}</h3>
                <p class="mb-2"><strong>{{__('strings.contact_office')}}:</strong> +607 - 595 3060</p>
                <p class="mb-2"><strong>{{__('strings.contact_mobile')}}:</strong> +6012 - 510 5126 <i>&lpar;{{__('strings.contact_mobile_whatsapp')}}&rpar;</i></p>
                <p class="mb-2"><strong>{{__('strings.contact_email')}}:</strong> mail@aquariuspools.com.my</p>
            </div>
        </div>
    </div>
</div>
@endsection