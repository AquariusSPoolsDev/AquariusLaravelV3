@php
use App\Models\CustReview;
// Only published reviews count, the same as on the Reviews page
$reviews = CustReview::query()->published()->latest('reviewed_at')->take(6)->get();
$reviewSummary = CustReview::platformSummary();
@endphp

<section class="focus-on-dark bg-linear-to-br from-primary-950 via-primary-800 to-primary-700 relative overflow-hidden">
    <div class="main-container relative z-10">
        <div class="max-w-2xl mx-auto text-center">
            <h2 class="aquarius-homepage-heading"><span class="text-white">{{__('strings.reviews_heading')}}</span></h2>
        </div>

        {{-- Reviews summary pills --}}
        <div class="mt-6 flex flex-wrap justify-center gap-3">
            <x-reusables.google-reviews-pill :avg="$reviewSummary['googleAverage']" :total="$reviewSummary['googleTotal']" variant="dark" />
            <x-reusables.facebook-recommendations-pill :recommended="$reviewSummary['facebookTotal']" :total="$reviewSummary['facebookTotal']" variant="dark" />
        </div>

        @if($reviews->isNotEmpty())
        <div class="aquarius-homepage-review-grid">
            @include('components.reviews.grid', ['reviews' => $reviews, 'animate' => true])
        </div>

        <div class="mt-10 text-center">
            <a href="{{ route('customer-reviews-page') }}" class="aquarius-reviews-btn">
                {{__('strings.reviews_view_all')}}
                <svg class="reviews-btn-arrow" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
            </a>
        </div>
        @else
        <p class="text-center text-white/60 mt-8">{{__('strings.reviews_view_all')}}</p>
        @endif
    </div>
</section>
