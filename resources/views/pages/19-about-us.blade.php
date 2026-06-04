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
    <x-seo.breadcrumb-schema :items="[
        ['name' => 'About Us', 'url' => route('about-page')],
    ]" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
<div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
    <div class="">

    </div>
    <div class="">
        
    </div>
</div>
@endsection
