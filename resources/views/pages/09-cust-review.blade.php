{{-- CUSTOMER REVIEWS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-customer-review.jpg';
$headerTitle = 'reviews_display_heading';
$headerSubtitle = 'reviews_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo.seo
        ogPageTitle="{{__('strings.reviews_title_heading')}}"
        ogDescription="{{__('strings.reviews_meta_description')}}"
        ogImage="{{ asset('assets/images/pool_header/'.$imageFileLoc) }}"
    />
    <x-seo.breadcrumb-schema :items="[
        ['name' => 'Customer Reviews', 'url' => route('customer-reviews-page')],
    ]" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 mb-8">
    <div>
        <p class="text-neutral-600">{{__('strings.reviews_body_title')}}</p>
    </div>
    <div class="flex flex-wrap gap-3">
        <x-reusables.google-reviews-pill :avg="$reviewSummary['googleAverage']" :total="$reviewSummary['googleTotal']" variant="light" />
        <x-reusables.facebook-recommendations-pill :recommended="$reviewSummary['facebookTotal']" :total="$reviewSummary['facebookTotal']" variant="light" />
    </div>
</div>

<div class="container">

    {{-- Loading indicator --}}
    <div id="reviews-loading" hidden class="flex py-12 justify-center items-center gap-3 text-neutral-500">
        <svg class="animate-spin h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span>{{ __('strings.reviews_loading') }}</span>
    </div>

    <div id="reviews-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        @include('components.reviews.grid', ['reviews' => $reviews])
    </div>

    <div id="reviews-pagination" class="mt-6 flex justify-center">
        {{ $reviews->links() }}
    </div>
</div>
@endsection
