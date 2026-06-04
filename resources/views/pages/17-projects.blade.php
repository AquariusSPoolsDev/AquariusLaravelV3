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
                        <svg class="w-16 h-16 text-primary-200" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="1.5" d="M2.25 15.75l5.159-5.159a2.25 2.25 0 013.182 0l5.159 5.159m-1.5-1.5l1.409-1.409a2.25 2.25 0 013.182 0l2.909 2.909M3 21h18M3.75 3h16.5M4.5 3v18M19.5 3v18" />
                        </svg>
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
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 10.5a3 3 0 11-6 0 3 3 0 016 0z" />
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M19.5 10.5c0 7.142-7.5 11.25-7.5 11.25S4.5 17.642 4.5 10.5a7.5 7.5 0 1115 0z" />
                            </svg>
                            {{ $project->location }}
                        </span>
                    @endif
                    @if($project->year_completed)
                        <span class="flex items-center gap-1">
                            <svg class="w-4 h-4" fill="none" stroke="currentColor" viewBox="0 0 24 24">
                                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6.75 3v2.25M17.25 3v2.25M3 18.75V7.5a2.25 2.25 0 012.25-2.25h13.5A2.25 2.25 0 0121 7.5v11.25m-18 0A2.25 2.25 0 005.25 21h13.5A2.25 2.25 0 0021 18.75m-18 0v-7.5A2.25 2.25 0 015.25 9h13.5A2.25 2.25 0 0121 11.25v7.5" />
                            </svg>
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
