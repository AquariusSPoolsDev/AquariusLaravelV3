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
    ogImage="{{ asset('assets/images/pool_header/'.$imageFileLoc) }}" />
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
<p class="mb-8 max-w-[60ch] leading-relaxed">{{ __('strings.fibreglass_pool_body') }}</p>

{{-- POOL STEPS --}}
<section class="pool-creation-steps-section mt-16">
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.fibreglass_pool_steps_title') }}</h2>
    @php
        // Step photo per step (without extension); steps without a photo yet show text only
        $fibreglassSteps = collect([1 => 'step-1', 2 => 'step-2', 3 => 'step-3', 4 => 'step-4'])
            ->map(fn (string $slug, int $step): string => 'assets/images/fibreglass/steps/'.$slug)
            ->all();
    @endphp
    <x-pool-creation-steps.process pool="fibreglass" :steps="$fibreglassSteps" />
</section>

{{-- PROS & CONS --}}
<section class="pool-pros-cons-section mt-16">
    <h2 class="aquarius-subheading mb-6!">{{ __('strings.fibreglass_pool_pros_cons_title') }}</h2>
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-6" data-animate data-delay="200">
        <x-our-pools-fibreglass.pool-advantage />
        <x-our-pools-fibreglass.pool-disadvantage />
    </div>
</section>

{{-- POOL GALLERY --}}
<section class="mt-16">
    <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
        <a href="{{ asset('assets/images/fibreglass/fibreglass-pool-1.jpg') }}" data-fslightbox="fibreglass-pools" class="block bg-info-bg overflow-hidden w-full aspect-4/3 border border-neutral-200 rounded-xl" data-animate data-delay="0">
            <img src="{{ asset('assets/images/fibreglass/fibreglass-pool-1.jpg') }}" alt="Finished fibreglass pool by Aquarius, photo 1 of 2" loading="lazy" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
        </a>
        <a href="{{ asset('assets/images/fibreglass/fibreglass-pool-2.jpg') }}" data-fslightbox="fibreglass-pools" class="block bg-info-bg overflow-hidden w-full aspect-4/3 border border-neutral-200 rounded-xl" data-animate data-delay="100">
            <img src="{{ asset('assets/images/fibreglass/fibreglass-pool-2.jpg') }}" alt="Finished fibreglass pool by Aquarius, photo 2 of 2" loading="lazy" class="w-full h-full object-cover transition-transform duration-300 hover:scale-105">
        </a>
    </div>
</section>

{{-- EXPLORE OTHER POOL TYPES --}}
<x-reusables.explore-pools current="fibreglass" />
@endsection

@section('cta')
<x-reusables.cta-banner href="{{ route('contact-page') }}?interest=Fibreglass+Pools"
    :title="__('strings.fibreglass_pool_cta_title')"
    :body="__('strings.fibreglass_pool_cta_body')" />
@endsection