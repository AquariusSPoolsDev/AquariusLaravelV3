{{-- FAQ PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.def-temp')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc   = 'pool-image-placeholder-4.jpg';
    $headerTitle    = 'faq_title_heading';
    $headerSubtitle = 'faq_subtitle_heading';
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
        
        <div class="">
            <p class="mb-3">
                {{ __('strings.faq_content_1') }}
            </p>
            <p class="mb-3">
                {{ __('strings.faq_content_2') }}
            </p>
            <p class="mb-8">
                {{ __('strings.faq_content_3') }}
            </p>
        </div>

        <div class="mx-auto text-center mt-16 mb-10">
            <h2 class="text-2xl font-bold md:text-4xl md:leading-tight">{{ __('strings.faq_heading_2') }}</h2>
        </div>

        <div class="container">
            <div class="hs-accordion-group aquarius-accordion-group-faq">

                {{-- ACCORDION CONTENT --}}
                <div class="hs-accordion aquarius-accordion active" id="accordion-content-1">
                    <button class="hs-accordion-toggle group aquarius-accordion-toggle" aria-expanded="true"
                        aria-controls="accordion-content-detail-1">
                        {{ __('strings.faq_choose_concrete') }}
                        <svg class="hs-accordion-active:hidden block toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                        <svg class="hs-accordion-active:block hidden toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>
                    </button>
                    <div id="accordion-content-detail-1" class="hs-accordion-content aquarius-accordion-content"
                        role="region" aria-labelledby="accordion-content-1">
                        <div class="pt-6 pr-8 text-primary-900">
                            <p class="mb-3">
                                {{ __('strings.faq_choose_concrete_answer') }}
                            </p>
                            <p class="mb-3">
                                <span
                                    class="text-lg font-semibold">{{ __('strings.faq_choose_concrete_answer_benefit_1') }}</span><br>
                                <span>{{ __('strings.faq_choose_concrete_answer_benefit_1_detail') }}</span>
                            </p>
                            <p class="mb-3">
                                <span
                                    class="text-lg font-semibold">{{ __('strings.faq_choose_concrete_answer_benefit_2') }}</span><br>
                                <span>{{ __('strings.faq_choose_concrete_answer_benefit_2_detail') }}</span>
                            </p>
                            <p class="mb-3">
                                <span
                                    class="text-lg font-semibold">{{ __('strings.faq_choose_concrete_answer_benefit_3') }}</span><br>
                                <span>{{ __('strings.faq_choose_concrete_answer_benefit_3_detail') }}</span>
                            </p>
                            <p class="mb-3">
                                <span
                                    class="text-lg font-semibold">{{ __('strings.faq_choose_concrete_answer_benefit_4') }}</span><br>
                                <span>{{ __('strings.faq_choose_concrete_answer_benefit_4_detail') }}</span>
                            </p>
                            <p class="">
                                <span
                                    class="text-lg font-semibold">{{ __('strings.faq_choose_concrete_answer_benefit_5') }}</span><br>
                                <span>{{ __('strings.faq_choose_concrete_answer_benefit_5_detail') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                {{-- ACCORDION CONTENT --}}

                {{-- ACCORDION CONTENT --}}
                <div class="hs-accordion aquarius-accordion" id="accordion-content-2">
                    <button class="hs-accordion-toggle group aquarius-accordion-toggle" aria-expanded="false"
                        aria-controls="accordion-content-detail-2">
                        {{ __('strings.faq_coping') }}
                        <svg class="hs-accordion-active:hidden block toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                        <svg class="hs-accordion-active:block hidden toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>
                    </button>
                    <div id="accordion-content-detail-2" class="hs-accordion-content hidden aquarius-accordion-content"
                        role="region" aria-labelledby="accordion-content-2">
                        <div class="pt-6 pr-8 text-primary-900">
                            <p class="mb-3">
                                {{ __('strings.faq_coping_answer_1') }}</p>
                            <p class="mb-3">
                                {{ __('strings.faq_coping_answer_2') }}</p>
                        </div>
                    </div>
                </div>
                {{-- ACCORDION CONTENT --}}

                {{-- ACCORDION CONTENT --}}
                <div class="hs-accordion aquarius-accordion" id="accordion-content-3">
                    <button class="hs-accordion-toggle group aquarius-accordion-toggle" aria-expanded="false"
                        aria-controls="accordion-content-detail-3">
                        {{ __('strings.faq_popular_pool_size') }}
                        <svg class="hs-accordion-active:hidden block toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                        <svg class="hs-accordion-active:block hidden toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>
                    </button>
                    <div id="accordion-content-detail-3" class="hs-accordion-content hidden aquarius-accordion-content"
                        role="region" aria-labelledby="accordion-content-3">
                        <div class="pt-6 pr-8 text-primary-900">
                            <p class="mb-3">
                                {{ __('strings.faq_popular_pool_size_answer_1') }}
                            </p>
                            <p class="mb-3">
                                {{ __('strings.faq_popular_pool_size_answer_2') }}
                            </p>
    
                            <ol class="mb-3 space-y-2 list-decimal list-inside">
                                <li>{{ __('strings.faq_popular_pool_size_answer_list_1') }}</li>
                                <li>{{ __('strings.faq_popular_pool_size_answer_list_2') }}</li>
                                <li>{{ __('strings.faq_popular_pool_size_answer_list_3') }}</li>
                                <li>{{ __('strings.faq_popular_pool_size_answer_list_4') }}</li>
                                <li>{{ __('strings.faq_popular_pool_size_answer_list_5') }}</li>
                            </ol>
    
                            <p class="">
                                {{ __('strings.faq_popular_pool_size_answer_3') }}
                            </p>
                        </div>
                    </div>
                </div>
                {{-- ACCORDION CONTENT --}}

                {{-- ACCORDION CONTENT --}}
                <div class="hs-accordion aquarius-accordion" id="accordion-content-4">
                    <button class="hs-accordion-toggle group aquarius-accordion-toggle" aria-expanded="false"
                        aria-controls="accordion-content-detail-4">
                        {{ __('strings.faq_pool_safe_kids') }}
                        <svg class="hs-accordion-active:hidden block toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                        <svg class="hs-accordion-active:block hidden toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>
                    </button>
                    <div id="accordion-content-detail-4" class="hs-accordion-content hidden aquarius-accordion-content"
                        role="region" aria-labelledby="accordion-content-4">
                        <div class="pt-6 pr-8 text-primary-900">
                            <p class="mb-3">
                                {{ __('strings.faq_pool_safe_kids_answer_1') }}
                            </p>
                            <p class="mb-3">
                                {{ __('strings.faq_pool_safe_kids_answer_2') }}
                            </p>
    
                            <ol class="mb-3 space-y-3 list-decimal list-inside">
                                <li class="mb-2">
                                    <strong>{{ __('strings.faq_pool_safe_kids_answer_tips_1') }}</strong> {{ __('strings.faq_pool_safe_kids_answer_tips_1_detail') }}
                                </li>
                                <li class="mb-2">
                                    <strong>{{ __('strings.faq_pool_safe_kids_answer_tips_2') }}</strong> {{ __('strings.faq_pool_safe_kids_answer_tips_2_detail') }}
                                </li>
                                <li class="mb-2">
                                    <strong>{{ __('strings.faq_pool_safe_kids_answer_tips_3') }}</strong> {{ __('strings.faq_pool_safe_kids_answer_tips_3_detail') }} 
                                </li>
                                <li class="mb-2">
                                    <strong>{{ __('strings.faq_pool_safe_kids_answer_tips_4') }}</strong> {{ __('strings.faq_pool_safe_kids_answer_tips_4_detail') }} 
                                </li>
                                <li class="mb-2">
                                    <strong>{{ __('strings.faq_pool_safe_kids_answer_tips_5') }}</strong>
                                    <ul class="ps-5 space-y-2 list-disc list-inside">
                                        <li>
                                            {{ __('strings.faq_pool_safe_kids_answer_tips_rule_1') }}
                                        </li>
                                        <li>
                                            {{ __('strings.faq_pool_safe_kids_answer_tips_rule_2') }}
                                        </li>
                                        <li>
                                            {{ __('strings.faq_pool_safe_kids_answer_tips_rule_3') }}
                                        </li>
                                    </ul>
                                </li>
                                <li class="">
                                    <strong>{{ __('strings.faq_pool_safe_kids_answer_tips_6') }}</strong> {{ __('strings.faq_pool_safe_kids_answer_tips_6_detail') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                {{-- ACCORDION CONTENT --}}

                {{-- ACCORDION CONTENT --}}
                <div class="hs-accordion aquarius-accordion" id="accordion-content-5">
                    <button class="hs-accordion-toggle group aquarius-accordion-toggle" aria-expanded="false"
                        aria-controls="accordion-content-detail-5">
                        {{ __('strings.faq_different_material_avail') }}
                        <svg class="hs-accordion-active:hidden block toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                        <svg class="hs-accordion-active:block hidden toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>
                    </button>
                    <div id="accordion-content-detail-5" class="hs-accordion-content hidden aquarius-accordion-content"
                        role="region" aria-labelledby="accordion-content-5">
                        <div class="pt-6 pr-8 text-primary-900">
                            <p class="">
                                {!!__('strings.faq_different_material_avail_answer')!!}
                            </p>
                        </div>
                    </div>
                </div>
                {{-- ACCORDION CONTENT --}}

                {{-- ACCORDION CONTENT --}}
                <div class="hs-accordion aquarius-accordion" id="accordion-content-6">
                    <button class="hs-accordion-toggle group aquarius-accordion-toggle" aria-expanded="false"
                        aria-controls="accordion-content-detail-6">
                        {{ __('strings.faq_kind_maintenance') }}
                        <svg class="hs-accordion-active:hidden block toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m6 9 6 6 6-6" />
                        </svg>
                        <svg class="hs-accordion-active:block hidden toggle-icon" xmlns="http://www.w3.org/2000/svg"
                            width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                            <path d="m18 15-6-6-6 6" />
                        </svg>
                    </button>
                    <div id="accordion-content-detail-6" class="hs-accordion-content hidden aquarius-accordion-content"
                        role="region" aria-labelledby="accordion-content-6">
                        <div class="pt-6 pr-8 text-primary-900">
                            <p class="mb-3">
                                {{ __('strings.faq_kind_maintenance_answer_1') }}
                            </p>
                            <ul class="mb-3 ps-5 space-y-3 list-disc list-inside">
                                <li>
                                    <strong>{{ __('strings.faq_kind_maintenance_answer_steps_1') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_1_detail') }}
                                </li>
                                <li>
                                    <strong>{{ __('strings.faq_kind_maintenance_answer_steps_2') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_2_detail') }}
                                </li>
                                <li>
                                    <strong>{{ __('strings.faq_kind_maintenance_answer_steps_3') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_3_detail') }}
                                </li>
                                <li>
                                    <strong>{{ __('strings.faq_kind_maintenance_answer_steps_4') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_4_detail') }}
                                </li>
                            </ul>
                            <p class="">
                                {!! __('strings.faq_kind_maintenance_answer_2') !!}
                            </p>
                        </div>
                    </div>
                </div>
                {{-- ACCORDION CONTENT --}}

            </div>
        </div>
    </div>
@endsection
