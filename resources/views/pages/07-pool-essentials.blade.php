{{-- POOL ITEMS & EQUIPMENTS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.def-temp')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-pool-items.jpg';
$headerTitle = 'pool_item_title_heading';
$headerSubtitle = 'pool_item_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo 
        ogPageTitle="{{__('strings.' . $headerTitle)}}"
        ogDescription="{{__('strings.' . $headerSubtitle)}}"
        ogImage="{{ asset('assets/images/'.$imageFileLoc) }}"
    /> 
@endsection

{{-- MAIN CONTENT STARTS HERE --}}
@section('content')
<div class="prose !max-w-full">
    <p class="">{{__('strings.pool_item_body')}} </p>

    {{-- MAIN ITEMS --}}
    <section id="main-pool-items-section">
        <h2 class="pool-item-title"> {{__('strings.pool_item_main_items')}}</h2>

        {{-- PUMP --}}
        <div class="pool-item-pump">
            <h3 class="pool-item-title-secondary">{{__('strings.pool_item_pump_title')}}</h3>
            <div class="flex flex-wrap lg:justify-between">
                <div class="w-full lg:w-[65%] order-1">
                    <p class="mt-0">{{__('strings.pool_item_pump_desc_1')}}</p>
                    <p class="">{{__('strings.pool_item_pump_desc_2')}}</p>
                    <p class="">{{__('strings.pool_item_pump_desc_3')}}</p>
                </div>
                <div class="w-full lg:w-[32%] order-3 lg:order-2 lg:mb-12">
                    <div class="bg-primary max-w-[27rem] h-52 lg:w-full lg:h-full rounded-xl overflow-hidden">
                    </div>
                    <div class="text-sm italic text-gray-600 mt-1">An example of a pool pump</div>
                </div>
                <div class="order-2 lg:order-3">
                    <p class="mt-0">{{__('strings.pool_item_pump_desc_4')}}</p>
                    <p class="">{{__('strings.pool_item_pump_summary')}}</p>
                </div>
                
            </div>
            <div class=""></div>
        </div>

        {{-- FILTER --}}
        <div class="pool-item-filter">
            <h3 class="pool-item-title-secondary">{{__('strings.pool_item_filter_title')}}</h3>
            <div class="flex flex-wrap lg:justify-between">
                <div class="w-full lg:w-[18%] order-3 lg:order-1 lg:mb-12">
                    <div class="bg-primary max-w-[18rem] h-52 lg:w-full lg:h-full rounded-xl overflow-hidden">
                    </div>
                    <div class="text-sm italic text-gray-600 mt-1">This is an image</div>
                </div>
                <div class="w-full lg:w-[78%] order-1 lg:order-2 lg:ms-6">
                    <p class="mt-0">{{__('strings.pool_item_filter_desc_1')}}</p>
                    <p class="">{{__('strings.pool_item_filter_desc_2')}}</p>
                    <p class="">{{__('strings.pool_item_filter_desc_3')}}</p>
                </div>
                <div class="w-full order-2 lg:order-3">
                    <p class="mt-0">{{__('strings.pool_item_filter_summary')}}</p>
                </div>
            </div>
        </div>
    </section>

    {{-- CLEANING EQUIPMENT --}}
    <div class="pool-item-cleaning">
        <h2 class="text-2xl lg:text-4xl text-primary-800">{{__('strings.pool_item_clean_accs_title')}}</h2>
        <p>{{__('strings.pool_item_clean_accs_body')}}</p>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">
            
            <x-pool-supplies.pool-item-card
                pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
                pool_item_title="{!!__('strings.pool_item_skimmer_title')!!}"
                pool_item_body="{!!__('strings.pool_item_skimmer_body')!!}"
            />

            <x-pool-supplies.pool-item-card
                pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
                pool_item_title="{{__('strings.pool_item_brush_title')}}"
                pool_item_body="{{__('strings.pool_item_brush_body')}}"
            />

            <x-pool-supplies.pool-item-card
                pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
                pool_item_title="{{__('strings.pool_item_vacuum_title')}}"
                pool_item_body="{{__('strings.pool_item_vacuum_body')}}"
            />

            <x-pool-supplies.pool-item-card
                pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
                pool_item_title="{{__('strings.pool_item_test_kit_title')}}"
                pool_item_body="{{__('strings.pool_item_test_kit_body')}}"
            />
        </div>
    </div>

    {{-- POOL CHEMICALS --}}
    <div class="pool-chemical-items">
        <h2 class="pool-item-title">{{__('strings.pool_item_chemicals_title')}}</h2>
        <p>{{__('strings.pool_item_chemicals_body')}}</p>
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-6 mt-8">

            <x-pool-supplies.pool-item-card
                pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
                pool_item_title="{{__('strings.pool_item_chlorine_title')}}"
                pool_item_body="{{__('strings.pool_item_chlorine_body')}}"
            />

            <x-pool-supplies.pool-item-card
                pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
                pool_item_title="{{__('strings.pool_item_ph_adjuster_title')}}"
                pool_item_body="{{__('strings.pool_item_ph_adjuster_body')}}"
            />

            <x-pool-supplies.pool-item-card
                pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
                pool_item_title="{{__('strings.pool_item_alkalinity_title')}}"
                pool_item_body="{!!__('strings.pool_item_alkalinity_body')!!}"
            />

            <x-pool-supplies.pool-item-card
                pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
                pool_item_title="{{__('strings.pool_item_algaecide_title')}}"
                pool_item_body="{{__('strings.pool_item_algaecide_body')}}"
            />

            <x-pool-supplies.pool-item-card
                pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
                pool_item_title="{{__('strings.pool_item_clarifier_title')}}"
                pool_item_body="{{__('strings.pool_item_clarifier_body')}}"
            />
        </div>
    </div>

    {{-- SALT CHLORINATOR --}}
    <div class="pool-item-salt-chlorinator">
        <h3 class="pool-item-title-secondary">{{__('strings.pool_item_salt_chlorinator_title')}}</h3>
        <div class="flex flex-wrap lg:justify-between">
            <div class="w-full lg:w-[65%]">
                <p class="mt-0">{{__('strings.pool_item_salt_chlorinator_body')}}</p>
                <p class="">{{__('strings.pool_item_salt_chlorinator_body_2')}}</p>
                <ul class="list-disc list-inside">
                    <li>{{__('strings.pool_item_salt_chlorinator_function_1')}}</li>
                    <li>{{__('strings.pool_item_salt_chlorinator_function_2')}}</li>
                    <li>{{__('strings.pool_item_salt_chlorinator_function_3')}}</li>
                    <li>{{__('strings.pool_item_salt_chlorinator_function_4')}}</li>
                </ul>
            </div>
            <div class="w-full lg:w-[32%] lg:mb-12">
                <div class="bg-primary max-w-[27rem] h-52 lg:w-full lg:h-full rounded-xl overflow-hidden">
                </div>
                <div class="text-sm italic text-gray-600 mt-1">A part of a salt chlorinator cell</div>
            </div>
            
        </div>
    </div>

    {{-- CLOSING --}}
    <p class="mt-8">{{__('strings.pool_item_closing_1')}}</p>
    <p class="">{{__('strings.pool_item_closing_2')}}</p>
</div>
@endsection