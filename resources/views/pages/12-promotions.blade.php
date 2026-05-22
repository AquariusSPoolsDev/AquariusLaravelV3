{{-- PROMOTIONS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-promotions.jpg';
$headerTitle = 'promotions_title_heading';
$headerSubtitle = 'promotions_subtitle_heading';
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

{{-- Loading indicator --}}
<div id="promos-loading" class="hidden py-12 justify-center items-center gap-3 text-neutral-500">
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

<script>
document.addEventListener('DOMContentLoaded', function () {
    const list = document.getElementById('promos-list');
    const pagination = document.getElementById('promos-pagination');
    const loading = document.getElementById('promos-loading');

    function initSwipers() {
        list.querySelectorAll('.promo-swiper').forEach(function (el) {
            if (el.swiper) { return; }
            new window.Swiper(el, {
                modules: [window.SwiperNavigation, window.SwiperPagination],
                loop: true,
                pagination: { el: el.querySelector('.swiper-pagination'), clickable: true },
                navigation: {
                    nextEl: el.querySelector('.swiper-button-next'),
                    prevEl: el.querySelector('.swiper-button-prev'),
                },
            });
        });
        if (typeof refreshFsLightbox === 'function') { refreshFsLightbox(); }
    }

    function attachPaginationListeners() {
        pagination.querySelectorAll('a').forEach(function (link) {
            link.addEventListener('click', function (e) {
                e.preventDefault();
                const url = new URL(this.href);
                const page = url.searchParams.get('page') || 1;
                fetchPromotions(page);
            });
        });
    }

    function fetchPromotions(page) {
        list.classList.add('opacity-0', 'pointer-events-none');
        loading.classList.remove('hidden');
        loading.classList.add('flex');

        axios.get('/promotions', {
            params: { page },
            headers: { 'X-Requested-With': 'XMLHttpRequest' }
        }).then(function (response) {
            list.innerHTML = response.data.html;
            pagination.innerHTML = response.data.pagination;
            attachPaginationListeners();
            initSwipers();
            window.scrollTo({ top: list.offsetTop - 100, behavior: 'smooth' });
        }).catch(function (error) {
            console.error('Error fetching promotions:', error);
        }).finally(function () {
            loading.classList.add('hidden');
            loading.classList.remove('flex');
            list.classList.remove('opacity-0', 'pointer-events-none');
        });
    }

    initSwipers();
    attachPaginationListeners();
});
</script>
@endsection
