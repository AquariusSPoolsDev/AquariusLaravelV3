{{-- POOL SERVICES PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.def-temp')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'pool-image-placeholder-4.jpg';
$headerTitle = 'pool_service_title_heading';
$headerSubtitle = 'pool_service_subtitle_heading';
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
<div class="">
    <p class="">{{__('strings.pool_service_content_1')}}</p>

    <div class="aquarius-pool-service-content">

        {{-- SERVICE #1 --}}
        <x-pool-services.pool-service-card 
            title="{{ __('strings.pool_service_item_1_title') }}" 
            :content="[__('strings.pool_service_item_1_content_1'),__('strings.pool_service_item_1_content_2')]" 
            image="assets/images/pool-design.jpg" 
            :isReversed="false" 
        />

        {{-- SERVICE #2 --}}
        <x-pool-services.pool-service-card 
            title="{{ __('strings.pool_service_item_2_title') }}" 
            :content="[__('strings.pool_service_item_2_content_1'), __('strings.pool_service_item_2_content_2'), __('strings.pool_service_item_2_content_3')]" 
            image="assets/images/pool-maintainence.jpg" 
            :isReversed="true" 
        />

        {{-- SERVICE #3 --}}
        <x-pool-services.pool-service-card 
            title="{{ __('strings.pool_service_item_3_title') }}" 
            :content="[__('strings.pool_service_item_3_content_1'),__('strings.pool_service_item_3_content_2'),__('strings.pool_service_item_3_content_3')]" 
            image="assets/images/pool-restore.jpg" 
            :isReversed="false" 
        />

        {{-- SERVICE #4 --}}
        <x-pool-services.pool-service-card 
            title="{{ __('strings.pool_service_item_4_title') }}" 
            :content="[__('strings.pool_service_item_4_content_1'), __('strings.pool_service_item_4_content_2'), __('strings.pool_service_item_4_content_3')]" 
            image="assets/images/pool-supplies.jpg" 
            :isReversed="true" 
        />

        {{-- SERVICE #5 --}}
        <x-pool-services.pool-service-card 
            title="{{ __('strings.pool_service_item_5_title') }}" 
            :content="[__('strings.pool_service_item_5_content_1')]" 
            image="assets/images/pool-after-sale.jpg" 
            :isReversed="false" 
        />
    </div>

</div>
@endsection