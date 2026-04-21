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
<div class="pb-10 mb-10 border-b border-neutral-200">
    <h2 class="aquarius-subheading">{{__('strings.sitemap_pages_heading')}}</h2>
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-4 gap-x-8 gap-y-4">
        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('contact-page') }}">{{__('strings.navbar_contact')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('faq-page') }}">{{__('strings.footer_faq')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('homepage') }}">{{__('strings.navbar_homepage')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('privacy-page') }}">{{__('strings.footer_privacy')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('promo-page') }}">{{__('strings.footer_promotion')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('customer-reviews-page') }}">{{__('strings.footer_reviews')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('pool-showcase-gallery') }}">{{__('strings.footer_pool_showcase')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('terms-page') }}">{{__('strings.footer_terms')}}</a>
    </div>
</div>


<div class="pb-10 mb-10 border-b border-neutral-200">
    <h2 class="aquarius-subheading">{{__('strings.sitemap_pools_heading')}}</h2>
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-4 gap-x-8 gap-y-4">
        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('concrete-pools-page') }}">{{__('strings.footer_our_pools_concrete')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('fibreglass-pools-page') }}">{{__('strings.footer_our_pools_fibreglass')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('our-pools-main') }}">{{__('strings.sitemap_pool_overview')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('vinyl-pools-page') }}">{{__('strings.footer_our_pools_vinyl')}}</a>
    </div>
</div>

<div class="pb-10">
    <h2 class="aquarius-subheading">{{__('strings.sitemap_pool_service_heading')}}</h2>
    <div class="mt-8 grid grid-cols-1 lg:grid-cols-4 gap-x-8 gap-y-4">
        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('pool-services-page') }}">{{__('strings.footer_our_services_pool')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="{{ route('pool-items-page') }}">{{__('strings.footer_our_services_essential')}}</a>

        <a class="font-semibold transition-all text-neutral-950 underline underline-offset-4 hover:no-underline active:no-underline"
            href="https://thesplashshop.com/">{{__('strings.footer_our_services_supplies')}}</a>
    </div>
</div>
@endsection
