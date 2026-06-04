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
        ogImage="{{ asset('assets/images/'.$imageFileLoc) }}"
    />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
<div class="flex flex-col lg:flex-row lg:items-center lg:justify-between gap-3 mb-8">
    <div>
        <x-reusables.pill-text>{{__('strings.reviews_pill')}}</x-reusables.pill-text>
        <p class="text-neutral-600">{{__('strings.reviews_body_title')}}</p>
    </div>
    <x-reusables.google-reviews-pill :avg="$averageRating ?? 0" :total="$totalReviews ?? 0" variant="light" />
</div>

<div class="container">

    {{-- Loading indicator --}}
    <div id="reviews-loading" class="hidden py-12 justify-center items-center gap-3 text-neutral-500">
        <svg class="animate-spin h-6 w-6 text-primary" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24">
            <circle class="opacity-25" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path class="opacity-75" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        <span>Loading reviews...</span>
    </div>

    <div id="reviews-grid" class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mt-6">
        @include('components.reviews.grid', ['reviews' => $reviews])
    </div>

    <div id="reviews-pagination" class="mt-6 flex justify-center">
        {{ $reviews->links() }}
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    const grid = document.getElementById('reviews-grid');
    const pagination = document.getElementById('reviews-pagination');
    const loading = document.getElementById('reviews-loading');

    function attachPaginationListeners() {
        pagination.querySelectorAll('a').forEach(link => {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const url = new URL(this.href);
                const page = url.searchParams.get('page') || 1;
                fetchReviews(page);
            });
        });
    }

    function fetchReviews(page) {
        grid.classList.add('opacity-0', 'pointer-events-none');
        loading.classList.remove('hidden');
        loading.classList.add('flex');

        axios.get('/reviews', {
            params: { page },
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(response => {
            grid.innerHTML = response.data.html;
            pagination.innerHTML = response.data.pagination;
            attachPaginationListeners();
            window.scrollTo({ top: grid.offsetTop - 100, behavior: 'smooth' });
        }).catch(error => {
            console.error('Error fetching reviews:', error);
        }).finally(() => {
            loading.classList.add('hidden');
            loading.classList.remove('flex');
            grid.classList.remove('opacity-0', 'pointer-events-none');
        });
    }

    attachPaginationListeners();
});
</script>
@endsection
