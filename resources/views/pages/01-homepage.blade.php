{{-- EXTENDS HOMEPAGE LAYOUT --}}
@extends('layout.homepage')

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo.seo
        ogDescription="{{ __('strings.homepage_meta_description') }}"
        ogImage="{{ asset('assets/images/pool-image-placeholder-5.jpg') }}"
    />
<x-seo.breadcrumb-schema :items="[]" />
@endsection

{{-- HOMEPAGE LAYOUT --}}
@section('content')
    <x-homepage.hero-section />

    <x-homepage.trust-section />

    <x-homepage.our-pools-section />

    <x-homepage.services-section />

    <x-homepage.showcase-section />

    <x-homepage.reviews-section />

    <x-homepage.cta-strip />

    <x-homepage.faq-section />

    <x-homepage.contact-section />
@endsection