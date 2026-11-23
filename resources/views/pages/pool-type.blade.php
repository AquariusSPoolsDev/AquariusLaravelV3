{{-- ONE PAGE FOR ALL THREE POOL TYPES: /concrete-pools, /vinyl-pools and /fibreglass-pools.
     The route passes $pool ('concrete', 'vinyl' or 'fibreglass'); text comes from the {pool}_pool_* strings
     and everything else that differs per pool is in $details below. --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

@php
    $details = [
        'concrete' => [
            'serviceName' => 'Concrete Swimming Pool Construction',
            'breadcrumb' => 'Concrete Pools',
            // the contact form's Interest option this page's CTA preselects
            'interest' => 'Tiled Concrete Pools',
            // build-step photos under public/, without extension; steps without a photo yet show text only
            'steps' => [
                1 => 'assets/images/concrete/steps/concrete-step-1-excavation',
                2 => 'assets/images/concrete/steps/concrete-step-2-framework',
                3 => 'assets/images/concrete/steps/concrete-step-3-plumbing',
                4 => 'assets/images/concrete/steps/concrete-step-4-concreting',
                5 => 'assets/images/concrete/steps/concrete-step-5-finishing',
            ],
            'photos' => 3,
        ],
        'vinyl' => [
            'serviceName' => 'Vinyl Swimming Pool Installation',
            'breadcrumb' => 'Vinyl Pools',
            'interest' => 'Steel Structure Vinyl Pools',
            'steps' => [
                1 => 'assets/images/vinyl/steps/vinyl-step-1-preparation',
                2 => 'assets/images/vinyl/steps/vinyl-step-2-excavation',
                3 => 'assets/images/vinyl/steps/vinyl-step-3-framework',
                4 => 'assets/images/vinyl/steps/vinyl-step-4-plumbing',
                5 => 'assets/images/vinyl/steps/vinyl-step-5-installation',
            ],
            'photos' => 3,
        ],
        'fibreglass' => [
            'serviceName' => 'Fibreglass Swimming Pool Installation',
            'breadcrumb' => 'Fibreglass Pools',
            'interest' => 'Fibreglass Pools',
            'steps' => [
                1 => 'assets/images/fibreglass/steps/step-1',
                2 => 'assets/images/fibreglass/steps/step-2',
                3 => 'assets/images/fibreglass/steps/step-3',
                4 => 'assets/images/fibreglass/steps/step-4',
            ],
            'photos' => 2,
        ],
    ][$pool];

    $pageRoute = $pool.'-pools-page';

    // PARSE HEADER STRINGS (read by the layout)
    $imageFileLoc = 'header-pool-'.$pool.'.jpg';
    $headerTitle = $pool.'_pool_display_heading';
    $headerSubtitle = $pool.'_pool_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
<x-seo.seo
    ogPageTitle="{{ __('strings.'.$pool.'_pool_title_heading') }}"
    ogDescription="{{ __('strings.'.$pool.'_pool_meta_description') }}"
    ogImage="{{ asset('assets/images/pool_header/'.$imageFileLoc) }}" />
<x-seo.service-schema
    serviceName="{{ $details['serviceName'] }}"
    serviceDescription="{{ __('strings.'.$pool.'_pool_meta_description') }}"
    serviceUrl="{{ route($pageRoute) }}" />
<x-seo.breadcrumb-schema :items="[
    ['name' => 'Our Pools', 'url' => route('our-pools-main')],
    ['name' => $details['breadcrumb'], 'url' => route($pageRoute)],
]" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
{{-- BODY TEXT MAIN --}}
<p class="mb-8 max-w-[60ch] leading-relaxed">{{ __('strings.'.$pool.'_pool_body') }}</p>

{{-- POOL STEPS --}}
<section class="pool-creation-steps-section mt-16">
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.'.$pool.'_pool_steps_title') }}</h2>
    <x-pool-creation-steps.process :pool="$pool" :steps="$details['steps']" />
</section>

{{-- PROS & CONS --}}
<section class="pool-pros-cons-section mt-16">
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.'.$pool.'_pool_pros_cons_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" data-animate data-delay="200">
        <x-our-pools.pros-cons-card :pool="$pool" type="advantage" />
        <x-our-pools.pros-cons-card :pool="$pool" type="disadvantage" />
    </div>
</section>

{{-- POOL GALLERY: photos are public/assets/images/{pool}/{pool}-pool-{n}.jpg. With 3 photos the last one
     spans the row on tablets. --}}
<section class="mt-16">
    <div class="grid grid-cols-1 md:grid-cols-2{{ $details['photos'] === 3 ? ' lg:grid-cols-3' : '' }} gap-4">
        @foreach (range(1, $details['photos']) as $photo)
            @php
                $photoUrl = asset('assets/images/'.$pool.'/'.$pool.'-pool-'.$photo.'.jpg');
                $spansRow = $details['photos'] === 3 && $loop->last;
            @endphp
            <a href="{{ $photoUrl }}" data-fslightbox="{{ $pool }}-pools" class="block bg-info-bg overflow-hidden w-full {{ $spansRow ? 'aspect-video lg:aspect-4/3' : 'aspect-4/3' }} border border-neutral-200 rounded-xl transition-all duration-200 hover:outline-3 hover:-outline-offset-3 hover:outline-primary-600 active:scale-97{{ $spansRow ? ' md:col-span-2 lg:col-span-1' : '' }}" data-animate data-delay="{{ $loop->index * 100 }}">
                <img src="{{ $photoUrl }}" alt="Finished {{ $pool }} pool by Aquarius, photo {{ $photo }} of {{ $details['photos'] }}" loading="lazy" class="w-full h-full object-cover">
            </a>
        @endforeach
    </div>
</section>

{{-- EXPLORE OTHER POOL TYPES --}}
<x-reusables.explore-pools :current="$pool" />
@endsection

@section('cta')
<x-reusables.cta-banner href="{{ route('contact-page') }}?interest={{ urlencode($details['interest']) }}"
    :title="__('strings.'.$pool.'_pool_cta_title')"
    :body="__('strings.'.$pool.'_pool_cta_body')" />
@endsection
