{{-- PROMOTIONS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-promotions.jpg';
$headerTitle = 'promotions_title_heading';
$headerSubtitle = 'promotions_subtitle_heading';
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
    <x-promotions.current-promo />
</div>
@endsection