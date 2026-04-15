{{-- POOL SHOWCASE GALLERY PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.def-temp')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'pool-image-placeholder-2.jpg';
$headerTitle = 'showcase_title_heading';
$headerSubtitle = 'showcase_subtitle_heading';
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
<div class="mb-6">
    <p class="mb-6">{{__('strings.showcase_body')}}</p>
    <x-reusables.alert color="info">
        <h3 id="howtouse" class="font-semibold text-lg lg:text-xl mb-3 tracking-tight">
            {{__('strings.showcase_how_to_use')}}
        </h3>
        <ol class="list-decimal list-inside text-sm lg:text-base flex flex-col gap-2">
            <li>&nbsp;<strong>{{__('strings.showcase_how_to_use_1_title')}}</strong> {{__('strings.showcase_how_to_use_1_body')}}</li>
            <li>&nbsp;<strong>{{__('strings.showcase_how_to_use_2_title')}}</strong> {{__('strings.showcase_how_to_use_2_body')}}</li>
            <li>&nbsp;<strong>{{__('strings.showcase_how_to_use_3_title')}}</strong> {{__('strings.showcase_how_to_use_3_body')}}</li>
            <li>&nbsp;<strong>{{__('strings.showcase_how_to_use_4_title')}}</strong> {{__('strings.showcase_how_to_use_4_body')}}</li>
        </ol>
    </x-reusables.alert>
</div>

<div id="gallery-container" class="image-gallery-container">
    <div class="flex flex-col">
        {{-- SEARCH INPUT --}}
        <div class="mb-4">
            <label for="search-input" class="font-semibold">{{__('strings.showcase_search_input_title')}}</label>
            @include('image-gallery.01-search-input')
        </div>

        {{-- TAGS --}}
        <div class="mb-4">
            <label class="font-semibold">{{__('strings.showcase_search_filter_tag_title')}}</label>

            {{-- USE THIS IN SMALLER VIEWPORT --}}
            @include('image-gallery.02-tags-small')

            {{-- USE THIS IN LARGER VIEWPORT --}}
            @include('image-gallery.03-tags-large')
        </div>

        {{-- RESET BUTTON --}}
        <div class="mb-4">
            @include('image-gallery.04-reset-btn')
        </div>

        {{-- LOADING INDICATOR --}}
        @include('image-gallery.05-loading')

        {{-- NO RESULT MESSAGE --}}
        @include('image-gallery.06-no-result-msg')
        
    </div>

    {{-- IMAGE GRID --}}
    <div id="image-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4">
        @include('image-gallery.grid', ['images' => $images])
    </div>

    {{-- PAGINATION PROVIDED ON LARAVEL --}}
    <div id="pagination" class="mt-6 flex justify-center">
        {{ $images->links() }}
    </div>
</div>
@endsection