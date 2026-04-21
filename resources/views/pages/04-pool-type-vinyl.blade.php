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
<x-seo.seo ogPageTitle="{{__('strings.' . $headerTitle)}}" ogDescription="{{__('strings.' . $headerSubtitle)}}"
    ogImage="{{ asset('assets/images/'.$imageFileLoc) }}" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
{{-- BODY TEXT MAIN --}}
<p class="mb-8 leading-relaxed">{{ __('strings.vinyl_pool_body') }}</p>

{{-- POOL STEPS --}}
<section class="pool-creation-steps-section mt-16">
    <x-reusables.pill-text>{{ __('strings.vinyl_pool_steps_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.vinyl_pool_steps_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-16 xl:gap-24">
        <x-our-pools-vinyl.pool-creation-steps />
        <x-our-pools-vinyl.pool-creation-steps-desc />
    </div>
</section>

{{-- PROS & CONS --}}
<section class="pool-pros-cons-section mt-16">
    <x-reusables.pill-text class="">{{ __('strings.vinyl_pool_pros_cons_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.vinyl_pool_pros_cons_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-our-pools-vinyl.pool-advantage />
        <x-our-pools-vinyl.pool-disadvantage />
    </div>
</section>

{{-- EXPLORE OTHER POOL TYPES --}}
<x-reusables.explore-pools current="vinyl" />
@endsection