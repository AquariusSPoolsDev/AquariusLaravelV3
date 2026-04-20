{{-- EXTENDS HOMEPAGE LAYOUT --}}
@extends('layout.homepage')

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo.seo 
        ogDescription="Discover our range of every pool type in the market. Sastify with your dream swimming pool with pool specialists in Johor Bahru (JB)!"
        ogImage="{{ asset('assets/images/pool-image-placeholder-5.jpg') }}"
    /> 
@endsection

{{-- HOMEPAGE LAYOUT --}}
@section('content')
    <x-homepage.hero-section />

    <x-homepage.our-pools-section />

    <x-homepage.showcase-section />

    <x-homepage.services-section />

    <x-homepage.reviews-section />

    <x-homepage.contact-section />
@endsection