@php
use App\Models\CustReview;
$reviews = CustReview::where('is_published', true)->orderBy('reviewed_at', 'desc')->take(6)->get();
$googleAvg = round(CustReview::where('source', 'Google Reviews')->avg('rating'), 1);
$googleTotal = CustReview::where('source', 'Google Reviews')->count();
$fbTotal = CustReview::where('source', 'Facebook')->count();
$fbRecommended = $fbTotal; // All published FB reviews are recommendations
@endphp

<section class="bg-linear-to-br from-primary-950 via-primary-800 to-primary-700 relative overflow-hidden">
    {{-- Dashed grid overlay --}}
    <div class="absolute inset-0 z-0 pointer-events-none" style="background-image: linear-gradient(to right, rgba(255,255,255,0.07) 1px, transparent 1px), linear-gradient(to bottom, rgba(255,255,255,0.07) 1px, transparent 1px); background-size: 24px 24px; mask-image: repeating-linear-gradient(to right, black 0px, black 3px, transparent 3px, transparent 8px), repeating-linear-gradient(to bottom, black 0px, black 3px, transparent 3px, transparent 8px); -webkit-mask-image: repeating-linear-gradient(to right, black 0px, black 3px, transparent 3px, transparent 8px), repeating-linear-gradient(to bottom, black 0px, black 3px, transparent 3px, transparent 8px); mask-composite: intersect; -webkit-mask-composite: source-in;"></div>
    <div class="main-container relative z-10">
        <h2 class="aquarius-homepage-heading" data-animate data-delay="0"><span class="text-white">{{__('strings.reviews_heading')}}</span></h2>

        {{-- Reviews summary pills --}}
        <div class="mt-6 flex flex-wrap justify-center gap-3" data-animate data-delay="100">
            <x-reusables.google-reviews-pill :avg="$googleAvg" :total="$googleTotal" variant="dark" />
            <x-reusables.facebook-recommendations-pill :recommended="$fbRecommended" :total="$fbTotal" variant="dark" />
        </div>

        @if($reviews->isNotEmpty())
        <div class="aquarius-homepage-review-grid">
            @include('components.reviews.grid', ['reviews' => $reviews, 'animate' => true])
        </div>

        <div class="mt-10 text-center" data-animate data-delay="750">
            <a href="{{ route('customer-reviews-page') }}" class="aquarius-reviews-btn">
                {{__('strings.reviews_view_all')}}
                <svg class="reviews-btn-arrow" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                </svg>
            </a>
        </div>
        @else
        <p class="text-center text-white/60 mt-8">{{__('strings.reviews_view_all')}}</p>
        @endif
    </div>
</section>
