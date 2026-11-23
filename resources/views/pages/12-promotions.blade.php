{{-- PROMOTIONS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-promotions.jpg';
$headerTitle = 'promotions_display_heading';
$headerSubtitle = 'promotions_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo.seo
        ogPageTitle="{{__('strings.promotions_title_heading')}}"
        ogDescription="{{__('strings.promotions_meta_description')}}"
        ogImage="{{ asset('assets/images/pool_header/'.$imageFileLoc) }}"
    />
    <x-seo.breadcrumb-schema :items="[
        ['name' => __('strings.promotions_display_heading'), 'url' => route('promo-page')],
    ]" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')

{{-- Loading indicator --}}
<div id="promos-loading" hidden class="flex py-12 justify-center items-center gap-3 text-neutral-500">
    <svg class="animate-spin h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
        <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
        <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
    </svg>
    <span>{{__('strings.promotions_loading')}}</span>
</div>

<div id="promos-list" class="flex flex-col gap-6">
    @include('components.promotions.grid', ['promotions' => $promotions])
</div>

<div id="promos-pagination" class="mt-6 flex justify-center">
    {{ $promotions->links() }}
</div>
@endsection
