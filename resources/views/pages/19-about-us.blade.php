{{-- ABOUT US PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc   = 'header-about-us.jpg';
    $headerTitle    = 'about_title_heading';
    $headerSubtitle = 'about_subtitle_heading';
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
<div class="flex flex-col gap-y-20 py-10">
    <x-reusables.alert color="info">This page does not have any content yet.</x-reusables.alert>
</div>
@endsection
