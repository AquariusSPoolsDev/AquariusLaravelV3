{{-- VINYL POOLS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc = 'header-pool-vinyl.jpg';
    $headerTitle = 'vinyl_pool_title_heading';
    $headerSubtitle = 'vinyl_pool_subtitle_heading';
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
<div class="prose !max-w-full">
    {{-- BODY TEXT MAIN --}}
    <p class="">{{ __('strings.vinyl_pool_body') }}</p>
    
    {{-- POOL STEPS --}}
    <x-our-pools-vinyl.pool-creation-steps />

    {{-- STEPS DESCRIPTION --}}
    <x-our-pools-vinyl.pool-creation-steps-desc />

    {{-- ADVANTAGE --}}
    <x-our-pools-vinyl.pool-advantage />

    {{-- DISADVANTAGE --}}
    <x-our-pools-vinyl.pool-disadvantage />
</div>
@endsection
