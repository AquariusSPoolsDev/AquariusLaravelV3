{{-- VINYL POOLS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-pool-vinyl.jpg';
$headerTitle = 'vinyl_pool_display_heading';
$headerSubtitle = 'vinyl_pool_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
<x-seo.seo
    ogPageTitle="{{__('strings.vinyl_pool_title_heading')}}"
    ogDescription="{{__('strings.vinyl_pool_meta_description')}}"
    ogImage="{{ asset('assets/images/pool_header/'.$imageFileLoc) }}" />
<x-seo.service-schema
    serviceName="Vinyl Swimming Pool Installation"
    serviceDescription="{{__('strings.vinyl_pool_meta_description')}}"
    serviceUrl="{{ route('vinyl-pools-page') }}" />
<x-seo.breadcrumb-schema :items="[
    ['name' => 'Our Pools', 'url' => route('our-pools-main')],
    ['name' => 'Vinyl Pools', 'url' => route('vinyl-pools-page')],
]" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
{{-- BODY TEXT MAIN --}}
<p class="mb-8 max-w-[60ch] leading-relaxed">{{ __('strings.vinyl_pool_body') }}</p>

{{-- POOL STEPS --}}
<section class="pool-creation-steps-section mt-16">
    <x-reusables.pill-text>{{ __('strings.vinyl_pool_steps_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.vinyl_pool_steps_title') }}</h2>
    @php
        // Step photo per step (without extension); steps without a photo yet show text only
        $vinylSteps = collect([1 => 'preparation', 2 => 'excavation', 3 => 'framework', 4 => 'plumbing', 5 => 'installation'])
            ->map(fn (string $slug, int $step): string => 'assets/images/vinyl/steps/vinyl-step-'.$step.'-'.$slug)
            ->all();
    @endphp
    <x-pool-creation-steps.process pool="vinyl" :steps="$vinylSteps" />
</section>

{{-- PROS & CONS --}}
<section class="pool-pros-cons-section mt-16">
    <x-reusables.pill-text>{{ __('strings.vinyl_pool_pros_cons_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.vinyl_pool_pros_cons_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" data-animate data-delay="200">
        <x-our-pools-vinyl.pool-advantage />
        <x-our-pools-vinyl.pool-disadvantage />
    </div>
</section>

{{-- POOL GALLERY --}}
<section class="mt-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ asset('assets/images/vinyl/vinyl-pool-1.jpg') }}" data-fslightbox="vinyl-pools" class="block bg-info-bg overflow-hidden w-full aspect-4/3 border border-neutral-200 rounded-xl" data-animate data-delay="0">
            <img src="{{ asset('assets/images/vinyl/vinyl-pool-1.jpg') }}" alt="Finished vinyl pool by Aquarius, photo 1 of 3" loading="lazy" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
        </a>
        <a href="{{ asset('assets/images/vinyl/vinyl-pool-2.jpg') }}" data-fslightbox="vinyl-pools" class="block bg-info-bg overflow-hidden w-full aspect-4/3 border border-neutral-200 rounded-xl" data-animate data-delay="100">
            <img src="{{ asset('assets/images/vinyl/vinyl-pool-2.jpg') }}" alt="Finished vinyl pool by Aquarius, photo 2 of 3" loading="lazy" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
        </a>
        <a href="{{ asset('assets/images/vinyl/vinyl-pool-3.jpg') }}" data-fslightbox="vinyl-pools" class="block bg-info-bg overflow-hidden w-full aspect-video lg:aspect-4/3 border border-neutral-200 rounded-xl md:col-span-2 lg:col-span-1" data-animate data-delay="200">
            <img src="{{ asset('assets/images/vinyl/vinyl-pool-3.jpg') }}" alt="Finished vinyl pool by Aquarius, photo 3 of 3" loading="lazy" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
        </a>
    </div>
</section>

{{-- EXPLORE OTHER POOL TYPES --}}
<x-reusables.explore-pools current="vinyl" />
@endsection

@section('cta')
<x-reusables.cta-banner href="{{ route('contact-page') }}?interest=Steel+Structure+Vinyl+Pools"
    :title="__('strings.vinyl_pool_cta_title')"
    :body="__('strings.vinyl_pool_cta_body')" />
@endsection