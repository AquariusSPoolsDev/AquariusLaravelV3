{{-- OUR POOLS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-our-pools.jpg';
$headerTitle = 'our_pools_title_heading';
$headerSubtitle = 'our_pools_subtitle_heading';
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

<div class="">
    <p class="mb-4">{!!__('strings.our_pools_body')!!}</p>

    <x-our-pools.pool-type-section />

    <x-our-pools.pool-type-compare-section />
</div>
@endsection