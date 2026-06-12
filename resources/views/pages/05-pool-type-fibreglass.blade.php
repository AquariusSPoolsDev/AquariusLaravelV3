{{-- FIBREGLASS POOLS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-pool-fibreglass.jpg';
$headerTitle = 'fibreglass_pool_display_heading';
$headerSubtitle = 'fibreglass_pool_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
<x-seo.seo ogPageTitle="{{__('strings.fibreglass_pool_title_heading')}}" ogDescription="{{__('strings.fibreglass_pool_meta_description')}}"
    ogImage="{{ asset('assets/images/'.$imageFileLoc) }}" />
<x-seo.service-schema
    serviceName="Fibreglass Swimming Pool Installation"
    serviceDescription="{{__('strings.fibreglass_pool_meta_description')}}"
    serviceUrl="{{ route('fibreglass-pools-page') }}" />
<x-seo.breadcrumb-schema :items="[
    ['name' => 'Our Pools', 'url' => route('our-pools-main')],
    ['name' => 'Fibreglass Pools', 'url' => route('fibreglass-pools-page')],
]" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
{{-- BODY TEXT MAIN --}}
<p class="mb-8 leading-relaxed" data-animate data-delay="0">{{ __('strings.fibreglass_pool_body') }}</p>

{{-- POOL STEPS --}}
<section class="pool-creation-steps-section mt-16">
    <x-reusables.pill-text data-animate data-delay="0">{{ __('strings.fibreglass_pool_steps_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!" data-animate data-delay="100">{{ __('strings.fibreglass_pool_steps_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-16 xl:gap-24" data-animate data-delay="200">
        <x-our-pools-fibreglass.pool-creation-steps />
        <x-our-pools-fibreglass.pool-creation-steps-desc />
    </div>

    {{-- STEP IMAGE GRID --}}
    <div class="grid grid-cols-2 lg:grid-cols-4 gap-4 mt-10">
        @foreach ([1, 2, 3, 4] as $step)
        <div data-animate data-delay="{{ ($loop->index) * 80 }}">
            <div class="overflow-hidden rounded-xl border border-neutral-200 bg-info-bg aspect-square">
                <img src="{{ asset('assets/images/fibreglass/steps/step-' . $step . '.jpg') }}"
                     alt="{{ __('strings.fibreglass_pool_step_' . $step . '_title') }}"
                     class="w-full h-full object-cover hover:scale-105 transition-all">
            </div>
            <p class="mt-2 italic text-neutral-700">{{ $step }}. {{ __('strings.fibreglass_pool_step_' . $step . '_title') }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- PROS & CONS --}}
<section class="pool-pros-cons-section mt-16">
    <x-reusables.pill-text data-animate data-delay="0">{{ __('strings.fibreglass_pool_pros_cons_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!" data-animate data-delay="100">{{ __('strings.fibreglass_pool_pros_cons_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" data-animate data-delay="200">
        <x-our-pools-fibreglass.pool-advantage />
        <x-our-pools-fibreglass.pool-disadvantage />
    </div>
</section>

{{-- POOL GALLERY --}}
<section class="mt-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <div class="bg-info-bg overflow-hidden w-full aspect-4/3 object-cover border border-neutral-200 rounded-xl" data-animate data-delay="0">
            <img src="{{ asset('assets/images/fibreglass/fibreglass-pool-1.jpg') }}" alt="Aquarius Pools Fibreglass Pool One Image" class="w-full h-auto hover:scale-105 active:scale-105 transition-all">
        </div>
        <div class="bg-info-bg overflow-hidden w-full aspect-4/3 object-cover border border-neutral-200 rounded-xl" data-animate data-delay="100">
            <img src="{{ asset('assets/images/fibreglass/fibreglass-pool-2.jpg') }}" alt="Aquarius Pools Fibreglass Pool Two Image" class="w-full h-auto hover:scale-105 active:scale-105 transition-all">
        </div>
    </div>
</section>

{{-- EXPLORE OTHER POOL TYPES --}}
<x-reusables.explore-pools current="fibreglass" />
@endsection

@section('cta')
<x-reusables.cta-banner href="{{ route('contact-page') }}?interest=Fibreglass+Pools" />
@endsection