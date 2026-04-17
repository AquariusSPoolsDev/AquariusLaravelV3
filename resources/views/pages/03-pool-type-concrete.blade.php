{{-- CONCRETE POOLS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.def-temp')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-pool-concrete.jpg';
$headerTitle = 'concrete_pool_title_heading';
$headerSubtitle = 'concrete_pool_subtitle_heading';
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
<div class="">
    {{-- BODY TEXT MAIN --}}
    <p class="">{{ __('strings.concrete_pool_body') }}</p>

    {{-- POOL STEPS --}}
    <x-our-pools-concrete.pool-creation-steps />

    {{-- STEPS DESCRIPTION --}}
    <x-our-pools-concrete.pool-creation-steps-desc />

    {{-- ADVANTAGE --}}
    <x-our-pools-concrete.pool-advantage />

    {{-- DISADVANTAGE --}}
    <x-our-pools-concrete.pool-disadvantage />

</div>
@endsection