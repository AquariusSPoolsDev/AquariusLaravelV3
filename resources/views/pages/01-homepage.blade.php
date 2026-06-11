{{-- EXTENDS HOMEPAGE LAYOUT --}}
@extends('layout.homepage')

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo.seo
        ogDescription="Over 1,000 pools built across Malaysia. Johor Bahru's swimming pool specialist. Concrete, vinyl, and fibreglass built to your specifications. Free consultation."
        ogImage="{{ asset('assets/images/pool-image-placeholder-5.jpg') }}"
    />
    <x-seo.local-business />
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

    <x-homepage.faq-section />

    <x-homepage.contact-section />
@endsection