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
<x-seo.breadcrumb-schema :items="[
    ['name' => 'Notable Projects', 'url' => route('projects-page')],
    ['name' => $project->title, 'url' => route('project-detail-page', $project->slug)],
]" />
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
        <svg class="w-4 h-4 group-hover:-translate-x-1 transition-all" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H59.31l58.35,58.34a8,8,0,0,1-11.32,11.32l-72-72a8,8,0,0,1,0-11.32l72-72a8,8,0,0,1,11.32,11.32L59.31,120H216A8,8,0,0,1,224,128Z"></path></svg>
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
                    <svg class="w-4 h-4 text-primary" viewBox="0 0 256 256" fill="currentColor"><path d="M112,80a16,16,0,1,1,16,16A16,16,0,0,1,112,80ZM64,80a64,64,0,0,1,128,0c0,59.95-57.58,93.54-60,94.95a8,8,0,0,1-7.94,0C121.58,173.54,64,140,64,80Zm16,0c0,42.2,35.84,70.21,48,78.5,12.15-8.28,48-36.3,48-78.5a48,48,0,0,0-96,0Zm122.77,67.63a8,8,0,0,0-5.54,15C213.74,168.74,224,176.92,224,184c0,13.36-36.52,32-96,32s-96-18.64-96-32c0-7.08,10.26-15.26,26.77-21.36a8,8,0,0,0-5.54-15C29.22,156.49,16,169.41,16,184c0,31.18,57.71,48,112,48s112-16.82,112-48C240,169.41,226.78,156.49,202.77,147.63Z"></path></svg>
                    <strong>{{ __('strings.projects_location_label') }}:</strong>&nbsp;{{ $project->location }}
                </span>
                @endif
                @if($project->year_completed)
                <span class="flex items-center gap-1.5">
                    <svg class="w-4 h-4 text-primary" viewBox="0 0 256 256" fill="currentColor"><path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-68-76a12,12,0,1,1-12-12A12,12,0,0,1,140,132Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,132ZM96,172a12,12,0,1,1-12-12A12,12,0,0,1,96,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,140,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,172Z"></path></svg>
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
                <svg xmlns="http://www.w3.org/2000/svg" class="size-6" viewBox="0 0 256 256" fill="currentColor"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>
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