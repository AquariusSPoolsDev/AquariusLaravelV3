{{-- NOTABLE PROJECTS PAGE --}}

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
    <x-seo.seo
        ogPageTitle="{{__('strings.projects_title_heading')}}"
        ogDescription="{{__('strings.projects_meta_description')}}"
        ogImage="{{ asset('assets/images/' . $imageFileLoc) }}"
    />
    <x-seo.breadcrumb-schema :items="[
        ['name' => 'Notable Projects', 'url' => route('projects-page')],
    ]" />
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')

@if($projects->isNotEmpty())
    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($projects as $project)
        <a href="{{ route('project-detail-page', $project->slug) }}" class="group bg-white border border-neutral-200 rounded-lg overflow-hidden h-full break-before-avoid transition-all duration-300 hover:-translate-y-1 hover:border-primary-300 hover:shadow-lg hover:shadow-primary-100">

            {{-- COVER IMAGE --}}
            <div class="aspect-video overflow-hidden bg-neutral-100">
                @if($project->gallery_images && count($project->gallery_images))
                    <img
                        src="{{ asset('storage/' . $project->gallery_images[0]) }}"
                        alt="{{ $project->title }}"
                        loading="lazy"
                        class="w-full h-full object-cover group-hover:scale-105 transition-transform duration-500"
                    >
                @else
                    <div class="w-full h-full flex items-center justify-center bg-primary-50">
                        <svg class="w-16 h-16 text-primary-200" viewBox="0 0 256 256" fill="currentColor"><path d="M216,40H40A16,16,0,0,0,24,56V200a16,16,0,0,0,16,16H216a16,16,0,0,0,16-16V56A16,16,0,0,0,216,40Zm0,16V158.75l-26.07-26.06a16,16,0,0,0-22.63,0l-20,20-44-44a16,16,0,0,0-22.62,0L40,149.37V56ZM40,172l52-52,80,80H40Zm176,28H194.63l-36-36,20-20L216,181.38V200ZM144,100a12,12,0,1,1,12,12A12,12,0,0,1,144,100Z"></path></svg>
                    </div>
                @endif
            </div>

            {{-- CARD CONTENT --}}
            <div class="flex flex-col flex-1 p-4">
                <h2 class="font-bold text-lg text-neutral-900 mb-1 group-hover:text-primary transition-colors">
                    {{ $project->title }}
                </h2>

                {{-- LOCATION & YEAR --}}
                <div class="flex flex-wrap gap-x-4 gap-y-1 text-sm text-neutral-500 mb-3">
                    @if($project->location)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" viewBox="0 0 256 256" fill="currentColor"><path d="M112,80a16,16,0,1,1,16,16A16,16,0,0,1,112,80ZM64,80a64,64,0,0,1,128,0c0,59.95-57.58,93.54-60,94.95a8,8,0,0,1-7.94,0C121.58,173.54,64,140,64,80Zm16,0c0,42.2,35.84,70.21,48,78.5,12.15-8.28,48-36.3,48-78.5a48,48,0,0,0-96,0Zm122.77,67.63a8,8,0,0,0-5.54,15C213.74,168.74,224,176.92,224,184c0,13.36-36.52,32-96,32s-96-18.64-96-32c0-7.08,10.26-15.26,26.77-21.36a8,8,0,0,0-5.54-15C29.22,156.49,16,169.41,16,184c0,31.18,57.71,48,112,48s112-16.82,112-48C240,169.41,226.78,156.49,202.77,147.63Z"></path></svg>
                            {{ $project->location }}
                        </span>
                    @endif
                    @if($project->year_completed)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" viewBox="0 0 256 256" fill="currentColor"><path d="M208,32H184V24a8,8,0,0,0-16,0v8H88V24a8,8,0,0,0-16,0v8H48A16,16,0,0,0,32,48V208a16,16,0,0,0,16,16H208a16,16,0,0,0,16-16V48A16,16,0,0,0,208,32ZM72,48v8a8,8,0,0,0,16,0V48h80v8a8,8,0,0,0,16,0V48h24V80H48V48ZM208,208H48V96H208V208Zm-68-76a12,12,0,1,1-12-12A12,12,0,0,1,140,132Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,132ZM96,172a12,12,0,1,1-12-12A12,12,0,0,1,96,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,140,172Zm44,0a12,12,0,1,1-12-12A12,12,0,0,1,184,172Z"></path></svg>
                            {{ $project->year_completed }}
                        </span>
                    @endif
                </div>

                {{-- TAGS --}}
                @if($project->tags && count($project->tags))
                    <div class="flex flex-wrap gap-1.5 mt-auto pt-3 border-t border-neutral-100">
                        @foreach($project->tags as $tag)
                            <span class="text-xs px-2 py-0.5 bg-primary/10 text-primary font-medium rounded-full">
                                {{ \App\Enums\PoolTags::translate($tag) }}
                            </span>
                        @endforeach
                    </div>
                @endif
            </div>
        </a>
        @endforeach
    </div>
@else
    <x-reusables.alert class="text-center">
        <h2 class="text-2xl font-semibold mb-3 mt-0">{{ __('strings.projects_no_projects_title') }}</h2>
        <p class="m-0">{{ __('strings.projects_no_projects_body') }}</p>
    </x-reusables.alert>
@endif

@endsection
