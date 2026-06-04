{{-- CONCRETE POOLS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-pool-concrete.jpg';
$headerTitle = 'concrete_pool_display_heading';
$headerSubtitle = 'concrete_pool_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
<x-seo.seo
    ogPageTitle="{{__('strings.concrete_pool_title_heading')}}"
    ogDescription="{{__('strings.concrete_pool_meta_description')}}"
    ogImage="{{ asset('assets/images/'.$imageFileLoc) }}" />
<x-seo.service-schema
    serviceName="Concrete Swimming Pool Construction"
    serviceDescription="{{__('strings.concrete_pool_meta_description')}}"
    serviceUrl="{{ route('concrete-pools-page') }}" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
{{-- BODY TEXT MAIN --}}
<p class="mb-8 leading-relaxed">{{ __('strings.concrete_pool_body') }}</p>

{{-- POOL STEPS --}}
<section class="pool-creation-steps-section mt-16">
    <x-reusables.pill-text>{{ __('strings.concrete_pool_steps_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.concrete_pool_steps_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-16 xl:gap-24">
        <x-our-pools-concrete.pool-creation-steps />
        <x-our-pools-concrete.pool-creation-steps-desc />
    </div>

    {{-- STEP IMAGE GRID --}}
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mt-10">
        @foreach ([1, 2, 3, 4, 5] as $step)
        <div>
            <div class="overflow-hidden rounded-xl border border-neutral-200 bg-info-bg aspect-square">
                <img src="{{ asset('assets/images/concrete/steps/step-' . $step . '.jpg') }}"
                     alt="{{ __('strings.concrete_pool_step_' . $step . '_title') }}"
                     class="w-full h-full object-cover hover:scale-105 transition-all">
            </div>
            <p class="mt-2 italic text-neutral-700">{{ $step }}. {{ __('strings.concrete_pool_step_' . $step . '_title') }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- PROS & CONS --}}
<section class="pool-pros-cons-section mt-16">
    <x-reusables.pill-text class="">{{ __('strings.concrete_pool_pros_cons_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.concrete_pool_pros_cons_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6">
        <x-our-pools-concrete.pool-advantage />
        <x-our-pools-concrete.pool-disadvantage />
    </div>
</section>

{{-- POOL GALLERY --}}
<section class="mt-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <div class="bg-info-bg overflow-hidden w-full aspect-4/3 object-cover border border-neutral-200 rounded-xl">
            <img src="{{ asset('assets/images/concrete/concrete-pool-1.jpg') }}" alt="Concrete pool 1" class="w-full h-auto hover:scale-105 active:scale-105 transition-all">
        </div>
        <div class="bg-info-bg overflow-hidden w-full aspect-4/3 object-cover border border-neutral-200 rounded-xl">
            <img src="{{ asset('assets/images/concrete/concrete-pool-2.jpg') }}" alt="Concrete pool 2" class="w-full h-auto hover:scale-105 active:scale-105 transition-all">
        </div>
        <div class="bg-info-bg overflow-hidden w-full aspect-video lg:aspect-4/3 object-cover border border-neutral-200 rounded-xl md:col-span-2 lg:col-span-1">
            <img src="{{ asset('assets/images/concrete/concrete-pool-3.jpg') }}" alt="Concrete pool 3" class="w-full h-auto hover:scale-105 active:scale-105 transition-all">
        </div>
    </div>
</section>

{{-- EXPLORE OTHER POOL TYPES --}}
<x-reusables.explore-pools current="concrete" />
@endsection

@section('cta')
<x-reusables.cta-banner />
@endsection