{{-- PROMOTIONS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.def-temp')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'pool-image-placeholder-3.jpg';
$headerTitle = 'promotions_title_heading';
$headerSubtitle = 'promotions_subtitle_heading';
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
    <x-promotions.current-promo />
</div>
@endsection