{{-- OUR POOLS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.def-temp')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'our-pools-concrete.jpg';
$headerTitle = 'our_pools_title_heading';
$headerSubtitle = 'our_pools_subtitle_heading';
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
    <p>{!!__('strings.our_pools_body')!!}</p>

    <x-our-pools.pool-type-section />

    <x-our-pools.pool-type-compare-section />
</div>
@endsection