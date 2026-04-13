{{-- THANK YOU PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.def-temp')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc   = 'pool-image-placeholder-4.jpg';
    $headerTitle    = 'submission_accepted_title_heading';
    $headerSubtitle = 'submission_accepted_subtitle_heading';
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
<div class="prose max-w-full">
    <p>{{__('strings.submission_accepted_body_1')}}</p>
    <p> {{__('strings.submission_accepted_body_2a')}} <a href="https://wa.me/60125105126" class="font-semibold hover:no-underline transition">{{__('strings.submission_accepted_whatsapp_link')}}</a> {{__('strings.submission_accepted_body_2b')}}</p>
</div>
@endsection