{{-- PROJECT DETAIL PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-pool-gallery.jpg';
$headerTitle = 'projects_title_heading';
$headerSubtitle = 'projects_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
<x-seo.seo ogPageTitle="{{ $project->title }}"
    ogDescription="{{ $project->location ? $project->title . ' — ' . $project->location : $project->title }}"
    ogImage="{{ ($project->gallery_images && count($project->gallery_images)) ? asset('storage/' . $project->gallery_images[0]) : asset('assets/images/' . $imageFileLoc) }}" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')

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

            <div class="flex flex-wrap gap-x-6 gap-y-2 text-sm text-gray-600 mb-4">
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
            <div class="flex flex-wrap gap-2">
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
        {{-- COVER IMAGE (first gallery image) --}}
        @if($project->gallery_images && count($project->gallery_images))
        <div class="rounded-2xl overflow-hidden mb-8 aspect-video bg-gray-100">
            <img src="{{ asset('storage/' . $project->gallery_images[0]) }}" alt="{{ $project->title }}"
                title="{{ $project->title }}" class="w-full h-full object-cover">
        </div>
        @endif
    </div>

    <div class="project-gallery lg:col-span-2 order-3">
        {{-- GALLERY --}}
        @if($project->gallery_images && count($project->gallery_images) > 1)
        <div class="mb-10">
            <div class="grid grid-cols-1 sm:grid-cols-2 lg:grid-cols-3 gap-4">
                @foreach(array_slice($project->gallery_images, 1) as $image)
                <div class="rounded-xl overflow-hidden aspect-video bg-gray-100">
                    <img src="{{ asset('storage/' . $image) }}" alt="{{ $project->title }}" loading="lazy"
                        class="w-full h-full object-cover hover:scale-105 transition-transform duration-500">
                </div>
                @endforeach
            </div>
        </div>
        @endif
    </div>
</div>

{{-- CTA --}}
<div class="bg-primary/5 border border-primary/20 rounded-2xl p-8 text-center">
    <h2 class="text-2xl font-bold text-neutral-900 mb-2">{{ __('strings.projects_contact_cta_title') }}</h2>
    <p class="text-gray-600 mb-6">{{ __('strings.projects_contact_cta_body') }}</p>
    <a href="{{ route('contact-page') }}"
        class="inline-flex items-center gap-2 bg-primary text-white font-semibold px-6 py-3 rounded-xl hover:bg-primary/90 transition-colors">
        {{ __('strings.projects_get_quote') }}
    </a>
</div>

@endsection