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
    ogImage="{{ asset('assets/images/pool_header/'.$imageFileLoc) }}" />
<x-seo.service-schema
    serviceName="Concrete Swimming Pool Construction"
    serviceDescription="{{__('strings.concrete_pool_meta_description')}}"
    serviceUrl="{{ route('concrete-pools-page') }}" />
<x-seo.breadcrumb-schema :items="[
    ['name' => 'Our Pools', 'url' => route('our-pools-main')],
    ['name' => 'Concrete Pools', 'url' => route('concrete-pools-page')],
]" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
{{-- BODY TEXT MAIN --}}
<p class="mb-8 max-w-[60ch] leading-relaxed">{{ __('strings.concrete_pool_body') }}</p>

{{-- POOL STEPS --}}
<section class="pool-creation-steps-section mt-16">
    <x-reusables.pill-text>{{ __('strings.concrete_pool_steps_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.concrete_pool_steps_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-3 gap-8 lg:gap-16 xl:gap-24">
        <x-our-pools-concrete.pool-creation-steps />
        <x-our-pools-concrete.pool-creation-steps-desc />
    </div>

    {{-- STEP IMAGE GRID --}}
    @php
        $concreteStepSlugs = [1 => 'excavation', 2 => 'framework', 3 => 'plumbing', 4 => 'concreting', 5 => 'finishing'];
    @endphp
    <div class="grid grid-cols-2 lg:grid-cols-5 gap-4 mt-10">
        @foreach ($concreteStepSlugs as $step => $slug)
        <div data-animate data-delay="{{ ($loop->index) * 80 }}">
            <a href="{{ asset('assets/images/concrete/steps/concrete-step-' . $step . '-' . $slug . '.jpg') }}" data-fslightbox="concrete-steps" class="block overflow-hidden rounded-xl border border-neutral-200 bg-info-bg aspect-square">
                <picture>
                    <source srcset="{{ asset('assets/images/concrete/steps/concrete-step-' . $step . '-' . $slug . '.webp') }}" type="image/webp">
                    <img src="{{ asset('assets/images/concrete/steps/concrete-step-' . $step . '-' . $slug . '.jpg') }}"
                         alt="{{ __('strings.concrete_pool_step_' . $step . '_title') }}"
                         class="w-full h-full object-cover hover:scale-105 transition-all"
                         loading="lazy">
                </picture>
            </a>
            <p class="mt-2 italic text-neutral-700">{{ $step }}. {{ __('strings.concrete_pool_step_' . $step . '_title') }}</p>
        </div>
        @endforeach
    </div>
</section>

{{-- PROS & CONS --}}
<section class="pool-pros-cons-section mt-16">
    <x-reusables.pill-text>{{ __('strings.concrete_pool_pros_cons_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.concrete_pool_pros_cons_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" data-animate data-delay="200">
        <x-our-pools-concrete.pool-advantage />
        <x-our-pools-concrete.pool-disadvantage />
    </div>
</section>

{{-- POOL GALLERY --}}
<section class="mt-16">
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-4">
        <a href="{{ asset('assets/images/concrete/concrete-pool-1.jpg') }}" data-fslightbox="concrete-pools" class="block bg-info-bg overflow-hidden w-full aspect-4/3 border border-neutral-200 rounded-xl" data-animate data-delay="0">
            <img src="{{ asset('assets/images/concrete/concrete-pool-1.jpg') }}" alt="Finished concrete pool by Aquarius, photo 1 of 3" loading="lazy" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
        </a>
        <a href="{{ asset('assets/images/concrete/concrete-pool-2.jpg') }}" data-fslightbox="concrete-pools" class="block bg-info-bg overflow-hidden w-full aspect-4/3 border border-neutral-200 rounded-xl" data-animate data-delay="100">
            <img src="{{ asset('assets/images/concrete/concrete-pool-2.jpg') }}" alt="Finished concrete pool by Aquarius, photo 2 of 3" loading="lazy" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
        </a>
        <a href="{{ asset('assets/images/concrete/concrete-pool-3.jpg') }}" data-fslightbox="concrete-pools" class="block bg-info-bg overflow-hidden w-full aspect-video lg:aspect-4/3 border border-neutral-200 rounded-xl md:col-span-2 lg:col-span-1" data-animate data-delay="200">
            <img src="{{ asset('assets/images/concrete/concrete-pool-3.jpg') }}" alt="Finished concrete pool by Aquarius, photo 3 of 3" loading="lazy" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
        </a>
    </div>
</section>

{{-- EXPLORE OTHER POOL TYPES --}}
<x-reusables.explore-pools current="concrete" />
@endsection

@section('cta')
<x-reusables.cta-banner href="{{ route('contact-page') }}?interest=Tiled+Concrete+Pools"
    :title="__('strings.concrete_pool_cta_title')"
    :body="__('strings.concrete_pool_cta_body')" />
@endsection