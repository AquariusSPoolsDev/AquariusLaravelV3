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
<div class="prose max-w-full mb-6">
    <p>{{__('strings.showcase_body')}}</p>

    <div class="bg-teal-50 border-s-4 border-teal-500 p-4 ps-6" role="alert" tabindex="-1" aria-labelledby="howtouse">
        <h3 id="howtouse" class="text-gray-800 font-semibold m-0">
            {{__('strings.showcase_how_to_use')}}
        </h3>
        <ol class="list-decimal list-inside text-sm text-gray-700 m-0 p-0">
            <li><strong>{{__('strings.showcase_how_to_use_1_title')}}</strong> {{__('strings.showcase_how_to_use_1_body')}}</li>
            <li><strong>{{__('strings.showcase_how_to_use_2_title')}}</strong> {{__('strings.showcase_how_to_use_2_body')}}</li>
            <li><strong>{{__('strings.showcase_how_to_use_3_title')}}</strong> {{__('strings.showcase_how_to_use_3_body')}}</li>
            <li><strong>{{__('strings.showcase_how_to_use_4_title')}}</strong> {{__('strings.showcase_how_to_use_4_body')}}</li>
        </ol>
    </div>
</div>

<div id="gallery-container">
    <div class="mb-4 flex flex-col">
        {{-- SEARCH INPUT --}}
        <label for="search-input" class="font-semibold mb-1">{{__('strings.showcase_search_input_title')}}</label>
        @include('image-gallery.01-search-input')

        {{-- TAGS --}}
        <label class="font-semibold mb-1 !mt-0">{{__('strings.showcase_search_filter_tag_title')}}</label>

        {{-- USE THIS IN SMALLER VIEWPORT --}}
        @include('image-gallery.02-tags-small')

        {{-- USE THIS IN LARGER VIEWPORT --}}
        @include('image-gallery.03-tags-large')

        {{-- RESET BUTTON --}}
        @include('image-gallery.04-reset-btn')
        
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