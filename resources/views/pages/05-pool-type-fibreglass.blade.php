{{-- FIBREGLASS POOLS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.def-temp')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc = 'our-pools-fibreglass.jpg';
    $headerTitle = 'fibreglass_pool_title_heading';
    $headerSubtitle = 'fibreglass_pool_subtitle_heading';
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
<div class="prose !max-w-full">
    {{-- BODY TEXT MAIN --}}
    <p class="">{{ __('strings.fibreglass_pool_body') }}</p>
    {{-- POOL STEPS --}}
    <x-our-pools-fibreglass.pool-creation-steps />

    {{-- STEPS DESCRIPTION --}}
    <x-our-pools-fibreglass.pool-creation-steps-desc />

    {{-- ADVANTAGE --}}
    <x-our-pools-fibreglass.pool-advantage />

    {{-- DISADVANTAGE --}}
    <x-our-pools-fibreglass.pool-disadvantage />
</div>
@endsection
