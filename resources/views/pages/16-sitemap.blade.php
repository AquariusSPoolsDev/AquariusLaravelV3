{{-- PRIVACY PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc   = 'header-sitemap.jpg';
    $headerTitle    = 'sitemap_title_heading';
    $headerSubtitle = 'sitemap_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo.seo 
        ogPageTitle="{{__('strings.' . $headerTitle)}}"
        ogDescription="{{__('strings.' . $headerSubtitle)}}"
        ogImage="{{ asset('assets/images/'.$imageFileLoc) }}"
    /> 
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
<div class="pb-10 mb-10 border-b">
    <h2 class="text-primary-800 text-2xl lg:text-4xl mb-8">{{__('strings.sitemap_pages_heading')}}</h2>
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-4 gap-4">
        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('contact-page') }}">{{__('strings.navbar_contact')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('faq-page') }}">{{__('strings.footer_faq')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('homepage') }}">{{__('strings.navbar_homepage')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('privacy-page') }}">{{__('strings.footer_privacy')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('promo-page') }}">{{__('strings.footer_promotion')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('customer-reviews-page') }}">{{__('strings.footer_reviews')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('pool-showcase-gallery') }}">{{__('strings.footer_pool_showcase')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('terms-page') }}">{{__('strings.footer_terms')}}</a>
    </div>
</div>


<div class="pb-10 mb-10 border-b">
    <h2 class="text-primary-800 text-2xl lg:text-4xl mb-8">{{__('strings.sitemap_pools_heading')}}</h2>
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-4 gap-4">
        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('concrete-pools-page') }}">{{__('strings.footer_our_pools_concrete')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('fibreglass-pools-page') }}">{{__('strings.footer_our_pools_fibreglass')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('our-pools-main') }}">{{__('strings.sitemap_pool_overview')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('vinyl-pools-page') }}">{{__('strings.footer_our_pools_vinyl')}}</a>
    </div>
</div>

<div class="pb-10">
    <h2 class="text-primary-800 text-2xl lg:text-4xl mb-8">{{__('strings.sitemap_pool_service_heading')}}</h2>
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-4 gap-4">
        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('pool-services-page') }}">{{__('strings.footer_our_services_pool')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="{{ route('pool-items-page') }}">{{__('strings.footer_our_services_essential')}}</a>

        <a class="text-primary-600 hover:text-primary-700 decoration-2 hover:underline focus:outline-none focus:underline"
            href="https://thesplashshop.com/">{{__('strings.footer_our_services_supplies')}}</a>
    </div>
</div>
@endsection