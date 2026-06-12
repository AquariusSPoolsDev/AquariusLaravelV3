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
    ogImage="{{ asset('assets/images/'.$imageFileLoc) }}" />
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
<p class="mb-8 leading-relaxed" data-animate data-delay="0">{{ __('strings.vinyl_pool_body') }}</p>

{{-- POOL STEPS --}}
<section class="pool-creation-steps-section mt-16">
    <x-reusables.pill-text data-animate data-delay="0">{{ __('strings.vinyl_pool_steps_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!" data-animate data-delay="100">{{ __('strings.vinyl_pool_steps_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-16 xl:gap-24" data-animate data-delay="200">
        <x-our-pools-vinyl.pool-creation-steps />
        <x-our-pools-vinyl.pool-creation-steps-desc />
    </div>

    {{-- STEP IMAGE GRID --}}
    @php
        $vinylStepSlugs = [1 => 'preparation', 2 => 'excavation', 3 => 'framework', 4 => 'plumbing', 5 => 'installation'];
    @endphp
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mt-10">
        @foreach ($vinylStepSlugs as $step => $slug)
        <div data-animate data-delay="{{ ($loop->index) * 80 }}">
            <div class="overflow-hidden rounded-xl border border-neutral-200 bg-info-bg aspect-square">
                <picture>
                    <source srcset="{{ asset('assets/images/vinyl/steps/vinyl-step-' . $step . '-' . $slug . '.webp') }}" type="image/webp">
                    <img src="{{ asset('assets/images/vinyl/steps/vinyl-step-' . $step . '-' . $slug . '.jpg') }}"
                         alt="{{ __('strings.vinyl_pool_step_' . $step . '_title') }}"
                         class="w-full h-full object-cover hover:scale-105 transition-all"
                         loading="lazy">
                </picture>
            </div>
            <p class="mt-2 italic text-neutral-700">{{ $step }}. {{ __('strings.vinyl_pool_step_' . $step . '_title') }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- PROS & CONS --}}
<section class="pool-pros-cons-section mt-16">
    <x-reusables.pill-text data-animate data-delay="0">{{ __('strings.vinyl_pool_pros_cons_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!" data-animate data-delay="100">{{ __('strings.vinyl_pool_pros_cons_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" data-animate data-delay="200">
        <x-our-pools-vinyl.pool-advantage />
        <x-our-pools-vinyl.pool-disadvantage />
    </div>
</section>

{{-- POOL GALLERY --}}
<section class="mt-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-info-bg overflow-hidden w-full aspect-4/3 object-cover border border-neutral-200 rounded-xl" data-animate data-delay="0">
            <img src="{{ asset('assets/images/vinyl/vinyl-pool-1.jpg') }}" alt="Aquarius Pools Finished Vinyl Pool One Image" class="w-full h-auto hover:scale-105 active:scale-105 transition-all">
        </div>
        <div class="bg-info-bg overflow-hidden w-full aspect-4/3 object-cover border border-neutral-200 rounded-xl" data-animate data-delay="100">
            <img src="{{ asset('assets/images/vinyl/vinyl-pool-2.jpg') }}" alt="Aquarius Pools Finished Vinyl Pool Two Image" class="w-full h-auto hover:scale-105 active:scale-105 transition-all">
        </div>
        <div class="bg-info-bg overflow-hidden w-full aspect-video lg:aspect-4/3 object-cover border border-neutral-200 rounded-xl md:col-span-2 lg:col-span-1" data-animate data-delay="200">
            <img src="{{ asset('assets/images/vinyl/vinyl-pool-3.jpg') }}" alt="Aquarius Pools Finished Vinyl Pool Three Image" class="w-full h-auto hover:scale-105 active:scale-105 transition-all">
        </div>
    </div>
</section>

{{-- EXPLORE OTHER POOL TYPES --}}
<x-reusables.explore-pools current="vinyl" />
@endsection

@section('cta')
<x-reusables.cta-banner href="{{ route('contact-page') }}?interest=Steel+Structure+Vinyl+Pools" />
@endsection