{{-- EXTENDS THE PAGE LAYOUT: no $headerTitle here, so there is no photo header --}}
@extends('layout.default')

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
    {{-- Order: what we build, the work, what customers say, that we're real (showroom), then
         the offer, services for existing pool owners, remaining questions, and contact.
         Backgrounds alternate: hero dark, pools light, showcase white, reviews dark, about white,
         CTA light, services white, FAQ light, contact white. --}}
    <x-homepage.hero-section />

    <x-homepage.our-pools-section />

    <x-homepage.showcase-section />

    <x-homepage.reviews-section />

    <x-homepage.trust-section />

    <x-homepage.cta-strip />

    <x-homepage.services-section />

    <x-homepage.faq-section />

    <x-homepage.contact-section />
@endsection