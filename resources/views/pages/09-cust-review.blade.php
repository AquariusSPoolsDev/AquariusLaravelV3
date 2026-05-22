{{-- CUSTOMER REVIEWS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-customer-review.jpg';
$headerTitle = 'reviews_title_heading';
$headerSubtitle = 'reviews_subtitle_heading';
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
<div class="prose max-w-full">
    <p class="">{{__('strings.reviews_body_title')}}</p>
</div>

<div class="container">
    <div class="flex flex-col md:flex-row md:justify-between my-6">
        <p class="font-bold max-md:mb-2">{{ $totalReviews }} {{__('strings.reviews_total_review')}}</p>
        <p class="">{{__('strings.reviews_avg_rating')}}
            <span class="text-secondary-800 font-semibold">{{ round($averageRating, 1) }} {{__('strings.reviews_of_5_star')}}</span>
        </p>
    </div>

    @if($reviews->isNotEmpty())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        @foreach($reviews as $review)
        <div
            class="p-6 bg-white rounded-xl shadow-lg hover:shadow-xl transition-shadow duration-300 border-l-4 border-primary">
            <div class="flex items-center mb-2">
                <h2 class="font-bold">{{ $review->reviewer_name }}</h2>
                <div class="ml-auto text-yellow-500">
                    {{ str_repeat('★', $review->rating) }}
                </div>
            </div>
            <div class="rich-text text-sm text-gray-700 italic">
                <div class=" inline-flex">{!! $review->review !!}</div>
            </div>
        </div>
        @endforeach
    </div>
    {{ $reviews->links() }}
    @else
        <div class="bg-red-50 border-s-4 border-red-500 rounded-e-xl p-6 ps-8" role="alert" tabindex="-1" aria-labelledby="noreview">
            <h2 id="noreview" class="text-2xl text-gray-800 font-semibold mb-3 mt-0">{{__('strings.reviews_no_review_title')}}</h2>
            <p class="text-gray-700 m-0">{{__('strings.reviews_no_review_body')}}</p>
        </div>
    @endif
</div>
@endsection