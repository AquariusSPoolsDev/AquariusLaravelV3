{{-- FAQ PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
    $imageFileLoc   = 'header-faq.jpg';
    $headerTitle    = 'faq_title_heading';
    $headerSubtitle = 'faq_subtitle_heading';
@endphp

{{-- META TAG PAGE --}}
@section('seoData')
   <x-seo.seo
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
            <x-reusables.pill-text>{{ __('strings.faq_pill') }}</x-reusables.pill-text>
            <h2 class="aquarius-subheading">{{ __('strings.faq_heading_2') }}</h2>
        </div>

        <div class="container">
            <div class="aquarius-accordion-group-faq" x-data="{ active: 0 }">

                {{-- ACCORDION ITEM --}}
                <div class="aquarius-accordion" :class="active === 0 && 'accordion-active'">
                    <button class="aquarius-accordion-toggle" :aria-expanded="active === 0" @click="active = active === 0 ? null : 0">
                        {{ __('strings.faq_choose_concrete') }}
                        <span class="toggle-icon" aria-hidden="true">
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none"><path d="M5.5 1v9M1 5.5h9" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
                        </span>
                    </button>
                    <div class="aquarius-accordion-content" x-show="active === 0" x-cloak x-transition role="region">
                        <div class="accordion-inner">
                            <p class="mb-3">{{ __('strings.faq_choose_concrete_answer') }}</p>
                            <p class="mb-3">
                                <span class="font-semibold text-neutral-900">{{ __('strings.faq_choose_concrete_answer_benefit_1') }}</span><br>
                                <span>{{ __('strings.faq_choose_concrete_answer_benefit_1_detail') }}</span>
                            </p>
                            <p class="mb-3">
                                <span class="font-semibold text-neutral-900">{{ __('strings.faq_choose_concrete_answer_benefit_2') }}</span><br>
                                <span>{{ __('strings.faq_choose_concrete_answer_benefit_2_detail') }}</span>
                            </p>
                            <p class="mb-3">
                                <span class="font-semibold text-neutral-900">{{ __('strings.faq_choose_concrete_answer_benefit_3') }}</span><br>
                                <span>{{ __('strings.faq_choose_concrete_answer_benefit_3_detail') }}</span>
                            </p>
                            <p class="mb-3">
                                <span class="font-semibold text-neutral-900">{{ __('strings.faq_choose_concrete_answer_benefit_4') }}</span><br>
                                <span>{{ __('strings.faq_choose_concrete_answer_benefit_4_detail') }}</span>
                            </p>
                            <p>
                                <span class="font-semibold text-neutral-900">{{ __('strings.faq_choose_concrete_answer_benefit_5') }}</span><br>
                                <span>{{ __('strings.faq_choose_concrete_answer_benefit_5_detail') }}</span>
                            </p>
                        </div>
                    </div>
                </div>
                {{-- END ACCORDION ITEM --}}

                {{-- ACCORDION ITEM --}}
                <div class="aquarius-accordion" :class="active === 1 && 'accordion-active'">
                    <button class="aquarius-accordion-toggle" :aria-expanded="active === 1" @click="active = active === 1 ? null : 1">
                        {{ __('strings.faq_coping') }}
                        <span class="toggle-icon" aria-hidden="true">
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none"><path d="M5.5 1v9M1 5.5h9" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
                        </span>
                    </button>
                    <div class="aquarius-accordion-content" x-show="active === 1" x-cloak x-transition role="region">
                        <div class="accordion-inner">
                            <p class="mb-3">{{ __('strings.faq_coping_answer_1') }}</p>
                            <p>{{ __('strings.faq_coping_answer_2') }}</p>
                        </div>
                    </div>
                </div>
                {{-- END ACCORDION ITEM --}}

                {{-- ACCORDION ITEM --}}
                <div class="aquarius-accordion" :class="active === 2 && 'accordion-active'">
                    <button class="aquarius-accordion-toggle" :aria-expanded="active === 2" @click="active = active === 2 ? null : 2">
                        {{ __('strings.faq_popular_pool_size') }}
                        <span class="toggle-icon" aria-hidden="true">
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none"><path d="M5.5 1v9M1 5.5h9" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
                        </span>
                    </button>
                    <div class="aquarius-accordion-content" x-show="active === 2" x-cloak x-transition role="region">
                        <div class="accordion-inner">
                            <p class="mb-3">{{ __('strings.faq_popular_pool_size_answer_1') }}</p>
                            <p class="mb-3">{{ __('strings.faq_popular_pool_size_answer_2') }}</p>
                            <ol class="mb-3 space-y-2 list-decimal list-inside">
                                <li>{{ __('strings.faq_popular_pool_size_answer_list_1') }}</li>
                                <li>{{ __('strings.faq_popular_pool_size_answer_list_2') }}</li>
                                <li>{{ __('strings.faq_popular_pool_size_answer_list_3') }}</li>
                                <li>{{ __('strings.faq_popular_pool_size_answer_list_4') }}</li>
                                <li>{{ __('strings.faq_popular_pool_size_answer_list_5') }}</li>
                            </ol>
                            <p>{{ __('strings.faq_popular_pool_size_answer_3') }}</p>
                        </div>
                    </div>
                </div>
                {{-- END ACCORDION ITEM --}}

                {{-- ACCORDION ITEM --}}
                <div class="aquarius-accordion" :class="active === 3 && 'accordion-active'">
                    <button class="aquarius-accordion-toggle" :aria-expanded="active === 3" @click="active = active === 3 ? null : 3">
                        {{ __('strings.faq_pool_safe_kids') }}
                        <span class="toggle-icon" aria-hidden="true">
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none"><path d="M5.5 1v9M1 5.5h9" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
                        </span>
                    </button>
                    <div class="aquarius-accordion-content" x-show="active === 3" x-cloak x-transition role="region">
                        <div class="accordion-inner">
                            <p class="mb-3">{{ __('strings.faq_pool_safe_kids_answer_1') }}</p>
                            <p class="mb-3">{{ __('strings.faq_pool_safe_kids_answer_2') }}</p>
                            <ol class="mb-3 space-y-3 list-decimal list-inside">
                                <li class="mb-2">
                                    <strong class="text-neutral-900">{{ __('strings.faq_pool_safe_kids_answer_tips_1') }}</strong> {{ __('strings.faq_pool_safe_kids_answer_tips_1_detail') }}
                                </li>
                                <li class="mb-2">
                                    <strong class="text-neutral-900">{{ __('strings.faq_pool_safe_kids_answer_tips_2') }}</strong> {{ __('strings.faq_pool_safe_kids_answer_tips_2_detail') }}
                                </li>
                                <li class="mb-2">
                                    <strong class="text-neutral-900">{{ __('strings.faq_pool_safe_kids_answer_tips_3') }}</strong> {{ __('strings.faq_pool_safe_kids_answer_tips_3_detail') }}
                                </li>
                                <li class="mb-2">
                                    <strong class="text-neutral-900">{{ __('strings.faq_pool_safe_kids_answer_tips_4') }}</strong> {{ __('strings.faq_pool_safe_kids_answer_tips_4_detail') }}
                                </li>
                                <li class="mb-2">
                                    <strong class="text-neutral-900">{{ __('strings.faq_pool_safe_kids_answer_tips_5') }}</strong>
                                    <ul class="ps-5 mt-2 space-y-2 list-disc list-inside">
                                        <li>{{ __('strings.faq_pool_safe_kids_answer_tips_rule_1') }}</li>
                                        <li>{{ __('strings.faq_pool_safe_kids_answer_tips_rule_2') }}</li>
                                        <li>{{ __('strings.faq_pool_safe_kids_answer_tips_rule_3') }}</li>
                                    </ul>
                                </li>
                                <li>
                                    <strong class="text-neutral-900">{{ __('strings.faq_pool_safe_kids_answer_tips_6') }}</strong> {{ __('strings.faq_pool_safe_kids_answer_tips_6_detail') }}
                                </li>
                            </ol>
                        </div>
                    </div>
                </div>
                {{-- END ACCORDION ITEM --}}

                {{-- ACCORDION ITEM --}}
                <div class="aquarius-accordion" :class="active === 4 && 'accordion-active'">
                    <button class="aquarius-accordion-toggle" :aria-expanded="active === 4" @click="active = active === 4 ? null : 4">
                        {{ __('strings.faq_different_material_avail') }}
                        <span class="toggle-icon" aria-hidden="true">
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none"><path d="M5.5 1v9M1 5.5h9" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
                        </span>
                    </button>
                    <div class="aquarius-accordion-content" x-show="active === 4" x-cloak x-transition role="region">
                        <div class="accordion-inner">
                            <p>{!!__('strings.faq_different_material_avail_answer')!!}</p>
                        </div>
                    </div>
                </div>
                {{-- END ACCORDION ITEM --}}

                {{-- ACCORDION ITEM --}}
                <div class="aquarius-accordion" :class="active === 5 && 'accordion-active'">
                    <button class="aquarius-accordion-toggle" :aria-expanded="active === 5" @click="active = active === 5 ? null : 5">
                        {{ __('strings.faq_kind_maintenance') }}
                        <span class="toggle-icon" aria-hidden="true">
                            <svg width="11" height="11" viewBox="0 0 11 11" fill="none"><path d="M5.5 1v9M1 5.5h9" stroke="currentColor" stroke-width="1.75" stroke-linecap="round"/></svg>
                        </span>
                    </button>
                    <div class="aquarius-accordion-content" x-show="active === 5" x-cloak x-transition role="region">
                        <div class="accordion-inner">
                            <p class="mb-3">{{ __('strings.faq_kind_maintenance_answer_1') }}</p>
                            <ul class="mb-3 ps-5 space-y-3 list-disc list-inside">
                                <li>
                                    <strong class="text-neutral-900">{{ __('strings.faq_kind_maintenance_answer_steps_1') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_1_detail') }}
                                </li>
                                <li>
                                    <strong class="text-neutral-900">{{ __('strings.faq_kind_maintenance_answer_steps_2') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_2_detail') }}
                                </li>
                                <li>
                                    <strong class="text-neutral-900">{{ __('strings.faq_kind_maintenance_answer_steps_3') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_3_detail') }}
                                </li>
                                <li>
                                    <strong class="text-neutral-900">{{ __('strings.faq_kind_maintenance_answer_steps_4') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_4_detail') }}
                                </li>
                            </ul>
                            <p>{!! __('strings.faq_kind_maintenance_answer_2') !!}</p>
                        </div>
                    </div>
                </div>
                {{-- END ACCORDION ITEM --}}

            </div>
        </div>
    </div>
@endsection
