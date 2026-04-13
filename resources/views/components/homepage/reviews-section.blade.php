@php
use App\Models\Review;
$reviews = Review::orderBy('created_at', 'desc')->take(6)->get();
@endphp

<section class="bg-primary-800">
    <div class="main-container">
        <h2 class="aquarius-homepage-heading"><span class="text-white">{{__('strings.reviews_heading')}}</span></h2>

        @if($reviews->isNotEmpty())
        <div class="aquarius-review-grid-homepage">
            {{-- CARD LOOP --}}
            @foreach ($reviews as $review)
            <div class="aquarius-review-card">
                <div class="review-card-content">
                    <div class="review-area">
                        <span class="review-text">{!!$review->review!!}</span>
                    </div>

                    <div class="reviewer-area">
                        <div class="reviewer-detail">
                            <div class="reviewer-image">
                                <img loading="lazy" src="{{ asset('assets/favicon/aquarius-logo-192.png') }}" alt="{{$review->reviewer_name}}" title="{{$review->reviewer_name}}">
                            </div>

                            <div class="reviewer-data">
                                <p class="reviewer-name">
                                    {{$review->reviewer_name}}
                                </p>
                                <p class="reviewer-location">
                                    {{$review->reviewer_location}}
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endforeach
            {{-- CARD LOOP --}}
        </div>
        @else
            <div class="mt-16 bg-red-50 border-s-4 border-red-500 rounded-e-xl p-6 ps-8" role="alert" tabindex="-1" aria-labelledby="noreview">
                <h3 id="noreview" class="text-2xl text-gray-800 font-semibold mb-3 mt-0">{{__('strings.reviews_no_review_title')}}</h3>
                <p class="text-gray-700 m-0">{{__('strings.reviews_no_review_body')}}</p>
            </div>
        @endif
    </div>
</section>
