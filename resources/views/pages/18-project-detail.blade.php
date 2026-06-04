{{-- PROJECT DETAIL PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-pool-gallery.jpg';
$headerTitle = 'projects_display_heading';
$headerSubtitle = 'projects_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
<x-seo.seo ogPageTitle="{{ $project->title }}"
    ogDescription="{{ $project->description ?: ($project->location ? $project->title . ', ' . $project->location : $project->title) }}"
    ogImage="{{ ($project->gallery_images && count($project->gallery_images)) ? asset('storage/' . $project->gallery_images[0]) : asset('assets/images/' . $imageFileLoc) }}" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')

<div
    x-data="{
        open: false,
        activeImage: '',
        openModal(src) { this.activeImage = src; this.open = true; document.body.classList.add('overflow-hidden'); },
        closeModal() { this.open = false; document.body.classList.remove('overflow-hidden'); }
    }"
    @keydown.escape.window="closeModal()"
>

{{-- BACK LINK --}}
<div class="mb-4">
    <a href="{{ route('projects-page') }}" class="inline-flex items-center gap-2 text-primary hover:underline hover:underline-offset-4 font-semibold text-sm transition-all group">
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-all" fill="none" stroke="currentColor" viewBox="0 0 24 24">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.5 19.5L3 12m0 0l7.5-7.5M3 12h18" />
        </svg>
        {{ __('strings.projects_back_to_projects') }}
    </a>
</div>

<div class="grid grid-cols-1 lg:grid-cols-2 gap-6 lg:gap-10">
    <div class="project-meta order-2 lg:order-1">
        {{-- TITLE + META --}}
        <div class="mb-8">
            <h1 class="text-3xl lg:text-5xl font-bold text-neutral-900 mb-5 lg:mb-7">{{ $project->title }}</h1>

            <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-neutral-600 mb-4 pb-4 border-b border-neutral-200">
                @if($project->location)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                    </svg>
                    <strong>{{ __('strings.projects_location_label') }}:</strong>&nbsp;{{ $project->location }}
                </span>
                @endif
                @if($project->year_completed)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-primary" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                            d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                    </svg>
                    <strong>{{ __('strings.projects_year_label') }}:</strong>&nbsp;{{ $project->year_completed }}
                </span>
                @endif
            </div>

            {{-- TAGS --}}
            @if($project->tags && count($project->tags))
            <div class="flex flex-wrap gap-2 pb-4 border-b border-neutral-200">
                @foreach($project->tags as $tag)
                <span class="text-sm px-3 py-1 bg-primary/10 text-primary font-medium rounded-full">
                    {{ \App\Enums\PoolTags::translate($tag) }}
                </span>
                @endforeach
            </div>
            @endif
        </div>

        {{-- DESCRIPTION --}}
        @if($project->description)
        <div class="prose max-w-full mb-10">
            {!! $project->description !!}
        </div>
        @endif
    </div>

    <div class="project-image order-1 lg:order-2">
        {{-- COVER IMAGE --}}
        @if($project->gallery_images && count($project->gallery_images))
        @php $coverSrc = asset('storage/' . $project->gallery_images[0]); @endphp
        <button
            type="button"
            @click="openModal('{{ $coverSrc }}')"
            class="pool-service-relative cursor-zoom-in w-full mb-4"
            aria-label="View image"
        >
            <div class="pool-service-absolute">
                <img src="{{ $coverSrc }}" alt="{{ $project->title }}" title="{{ $project->title }} Image" loading="lazy"
                    class="pool-service-img-content">
            </div>
        </button>
        @endif
    </div>

    <div class="project-gallery lg:col-span-2 order-3">
        {{-- GALLERY --}}
        @if($project->gallery_images && count($project->gallery_images) > 1)
        <div class="mb-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-6 lg:gap-8">
                @foreach(array_slice($project->gallery_images, 1) as $image)
                @php $src = asset('storage/' . $image); @endphp
                <button
                    type="button"
                    @click="openModal('{{ $src }}')"
                    class="pool-service-relative cursor-zoom-in"
                    aria-label="View image"
                >
                    <div class="pool-service-absolute">
                        <img src="{{ $src }}" title="{{ $project->title }} Image" alt="{{ $project->title }} Image" loading="lazy"
                            class="pool-service-img-content">
                    </div>
                </button>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

{{-- IMAGE LIGHTBOX MODAL --}}
<template x-teleport="body">
    <div
        x-show="open"
        x-cloak
        x-transition:enter="transition-opacity ease-out duration-300"
        x-transition:enter-start="opacity-0"
        x-transition:enter-end="opacity-100"
        x-transition:leave="transition-opacity ease-in duration-200"
        x-transition:leave-start="opacity-100"
        x-transition:leave-end="opacity-0"
        @click="closeModal()"
        class="pool-item-modal-backdrop"
    >
        <div
            x-show="open"
            x-transition:enter="transition ease-out duration-300"
            x-transition:enter-start="opacity-0 scale-95"
            x-transition:enter-end="opacity-100 scale-100"
            x-transition:leave="transition ease-in duration-200"
            x-transition:leave-start="opacity-100 scale-100"
            x-transition:leave-end="opacity-0 scale-95"
            @click.stop
            class="relative max-w-5xl w-full mx-4 rounded-2xl overflow-hidden bg-black shadow-2xl"
        >
            <button
                @click="closeModal()"
                class="absolute top-3 right-3 z-10 bg-black/50 hover:bg-black/70 text-white rounded-full p-1.5 transition-colors"
                aria-label="Close" title="Close"
            >
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                    <path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/>
                </svg>
            </button>
            <img :src="activeImage" title="{{ $project->title }} Image" alt="{{ $project->title }}" class="w-full max-h-[85vh] object-cover aspect-4/3 lg:aspect-video">
        </div>
    </div>
</template>

</div>

@endsection

@section('cta')
<x-reusables.cta-banner />
@endsection