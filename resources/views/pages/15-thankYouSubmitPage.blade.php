{{-- THANK YOU PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc   = 'header-thankyou.jpg';
    $headerTitle    = 'submission_accepted_display_heading';
    $headerSubtitle = 'submission_accepted_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo.seo
        ogPageTitle="{{__('strings.submission_accepted_title_heading')}}"
        ogDescription="{{__('strings.submission_accepted_subtitle_heading')}}"
        ogImage="{{ asset('assets/images/'.$imageFileLoc) }}"
        :noIndex="true"
    /> 
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
<div class="mb-10">
    <p class="mb-4">{{__('strings.submission_accepted_body_1')}}</p>
    <p> {{__('strings.submission_accepted_body_2a')}} <a href="https://wa.me/60125105126" class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline">{{__('strings.submission_accepted_whatsapp_link')}}</a> {{__('strings.submission_accepted_body_2b')}}</p>
</div>

<p class="mt-10 mb-4 text-lg font-semibold uppercase tracking-widest text-neutral-800">{{ __('strings.submission_accepted_cta_heading') }}</p>

<div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
    {{-- WhatsApp --}}
    <a href="https://wa.me/60125105126" target="_blank" title="{{ __('strings.submission_accepted_cta_wa_title') }}"
        class="group flex items-center gap-4 bg-white border border-neutral-200 rounded-lg p-4 lg:p-6 transition-all duration-200 hover:-translate-y-1 hover:border-green-300 hover:shadow-lg hover:shadow-green-100 active:scale-95 active:shadow-none active:translate-y-0">
        <div class="shrink-0 flex items-center justify-center w-12 h-12 rounded-full bg-green-50 text-green-600 transition-colors group-hover:bg-green-100">
            <svg class="size-6 fill-current" role="img" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path d="M17.472 14.382c-.297-.149-1.758-.867-2.03-.967-.273-.099-.471-.148-.67.15-.197.297-.767.966-.94 1.164-.173.199-.347.223-.644.075-.297-.15-1.255-.463-2.39-1.475-.883-.788-1.48-1.761-1.653-2.059-.173-.297-.018-.458.13-.606.134-.133.298-.347.446-.52.149-.174.198-.298.298-.497.099-.198.05-.371-.025-.52-.075-.149-.669-1.612-.916-2.207-.242-.579-.487-.5-.669-.51-.173-.008-.371-.01-.57-.01-.198 0-.52.074-.792.372-.272.297-1.04 1.016-1.04 2.479 0 1.462 1.065 2.875 1.213 3.074.149.198 2.096 3.2 5.077 4.487.709.306 1.262.489 1.694.625.712.227 1.36.195 1.871.118.571-.085 1.758-.719 2.006-1.413.248-.694.248-1.289.173-1.413-.074-.124-.272-.198-.57-.347m-5.421 7.403h-.004a9.87 9.87 0 01-5.031-1.378l-.361-.214-3.741.982.998-3.648-.235-.374a9.86 9.86 0 01-1.51-5.26c.001-5.45 4.436-9.884 9.888-9.884 2.64 0 5.122 1.03 6.988 2.898a9.825 9.825 0 012.893 6.994c-.003 5.45-4.437 9.884-9.885 9.884m8.413-18.297A11.815 11.815 0 0012.05 0C5.495 0 .16 5.335.157 11.892c0 2.096.547 4.142 1.588 5.945L.057 24l6.305-1.654a11.882 11.882 0 005.683 1.448h.005c6.554 0 11.89-5.335 11.893-11.893a11.821 11.821 0 00-3.48-8.413Z"/></svg>
        </div>
        <div>
            <p class="font-semibold text-neutral-900 text-xl">{{ __('strings.submission_accepted_cta_wa_title') }}</p>
            <p class=" text-neutral-500">{{ __('strings.submission_accepted_cta_wa_desc') }}</p>
        </div>
    </a>

    {{-- Explore Pools --}}
    <a href="{{ route('our-pools-main') }}" title="{{ __('strings.submission_accepted_cta_pools_title') }}"
        class="group flex items-center gap-4 bg-white border border-neutral-200 rounded-lg p-4 lg:p-6 transition-all duration-200 hover:-translate-y-1 hover:border-primary-300 hover:shadow-lg hover:shadow-primary-100 active:scale-95 active:shadow-none active:translate-y-0">
        <div class="shrink-0 flex items-center justify-center w-12 h-12 rounded-full bg-primary-50 text-primary-600 transition-colors group-hover:bg-primary-100">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M219.31,108.68l-80-80a16,16,0,0,0-22.62,0l-80,80A15.87,15.87,0,0,0,32,120v96a8,8,0,0,0,8,8h64a8,8,0,0,0,8-8V160h32v56a8,8,0,0,0,8,8h64a8,8,0,0,0,8-8V120A15.87,15.87,0,0,0,219.31,108.68ZM208,208H160V152a8,8,0,0,0-8-8H104a8,8,0,0,0-8,8v56H48V120l80-80,80,80Z"></path></svg>
        </div>
        <div>
            <p class="font-semibold text-neutral-900 text-xl">{{ __('strings.submission_accepted_cta_pools_title') }}</p>
            <p class="text-neutral-500">{{ __('strings.submission_accepted_cta_pools_desc') }}</p>
        </div>
    </a>

    {{-- View Projects --}}
    <a href="{{ route('projects-page') }}" title="{{ __('strings.submission_accepted_cta_projects_title') }}"
        class="group flex items-center gap-4 bg-white border border-neutral-200 rounded-lg p-4 lg:p-6 transition-all duration-200 hover:-translate-y-1 hover:border-secondary-300 hover:shadow-lg hover:shadow-secondary-100 active:scale-95 active:shadow-none active:translate-y-0">
        <div class="shrink-0 flex items-center justify-center w-12 h-12 rounded-full bg-secondary-50 text-secondary-600 transition-colors group-hover:bg-secondary-100">
            <svg class="size-6" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M216,40H40A16,16,0,0,0,24,56V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A16,16,0,0,0,216,40Zm0,16V158.75l-26.07-26.06a16,16,0,0,0-22.63,0l-20,20-44-44a16,16,0,0,0-22.62,0L40,149.37V56ZM40,172l52-52,80,80H40Zm176,28H194.63l-36-36,20-20L216,181.38V200ZM144,100a12,12,0,1,1,12,12A12,12,0,0,1,144,100Z"></path></svg>
        </div>
        <div>
            <p class="font-semibold text-neutral-900 text-xl">{{ __('strings.submission_accepted_cta_projects_title') }}</p>
            <p class="text-neutral-500">{{ __('strings.submission_accepted_cta_projects_desc') }}</p>
        </div>
    </a>
</div>
<script>
    gtag('event', 'generate_lead', {
        'event_category': 'contact_form',
        'event_label': 'pool_inquiry',
        'value': 1
    });
</script>
@endsection