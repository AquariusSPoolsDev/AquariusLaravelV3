{{-- POOL ITEMS & EQUIPMENTS PAGE --}}

{{-- EXTENDS DEFAULT LAYOUT --}}
@extends('layout.default')

{{-- PARSE HEADER STRINGS --}}
@php
$imageFileLoc = 'header-pool-items.jpg';
$headerTitle = 'pool_item_title_heading';
$headerSubtitle = 'pool_item_subtitle_heading';
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

{{-- INTRO --}}
<p class="mb-10 leading-relaxed">{{ __('strings.pool_item_body') }}</p>

{{-- ANCHOR NAV --}}
<nav class="sticky top-0 z-10 bg-white/90 backdrop-blur-sm py-3 mb-10 -mx-4 px-4 border-b border-neutral-100">
    <div class="flex flex-wrap gap-2">
        <a href="#core-equipment"
            class="inline-flex items-center px-4 py-1.5 rounded-full text-base lg:text-lg font-semibold font-heading tracking-tight transition-colors bg-primary-700 text-white hover:bg-primary-800">
            {{ __('strings.pool_item_nav_core') }}
        </a>
        <a href="#cleaning"
            class="inline-flex items-center px-4 py-1.5 rounded-full text-base lg:text-lg font-semibold font-heading tracking-tight transition-colors bg-primary-50 text-primary-800 hover:bg-primary-100">
            {{ __('strings.pool_item_nav_cleaning') }}
        </a>
        <a href="#chemicals"
            class="inline-flex items-center px-4 py-1.5 rounded-full text-base lg:text-lg font-semibold font-heading tracking-tight transition-colors bg-primary-50 text-primary-800 hover:bg-primary-100">
            {{ __('strings.pool_item_nav_chemicals') }}
        </a>
    </div>
</nav>

{{-- CORE EQUIPMENT --}}
<section id="core-equipment" class="scroll-mt-20 mb-16">
    <x-reusables.pill-text>{{ __('strings.pool_item_core_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-3!">{{ __('strings.pool_item_core_title') }}</h2>
    <p class="mb-8 text-neutral-600">{{ __('strings.pool_item_core_body') }}</p>

    <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
        <x-pool-supplies.pool-item-card-portrait
            pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_pump_title') }}"
            pool_item_brief="{{ __('strings.pool_item_pump_brief') }}"
        />
        <x-pool-supplies.pool-item-card-portrait
            pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_filter_title') }}"
            pool_item_brief="{{ __('strings.pool_item_filter_brief') }}"
        />
        <x-pool-supplies.pool-item-card-portrait
            pool_item_image="{{ asset('assets/images/hero-image-3.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_salt_chlorinator_title') }}"
            pool_item_brief="{{ __('strings.pool_item_salt_chlorinator_brief') }}"
        />
    </div>
</section>

{{-- CLEANING ACCESSORIES --}}
<section id="cleaning" class="scroll-mt-20 mb-16">
    <x-reusables.pill-text>{{ __('strings.pool_item_equip_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-3!">{{ __('strings.pool_item_equip_title') }}</h2>
    <p class="mb-8 text-neutral-600">{{ __('strings.pool_item_equip_body') }}</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/2-in-1-test-kit.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_test_kit_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_test_kit_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_test_kit_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_test_kit_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_test_kit_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/chemical-scoop.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_chem_scoop_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_chem_scoop_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_chem_scoop_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_chem_scoop_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_chem_scoop_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/powerflo-vacuum-hose.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_vacuum_hose_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_vacuum_hose_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_vacuum_hose_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_vacuum_hose_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_vacuum_hose_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/chlorine-tablet-dispenser.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_tablet_dispenser_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_tablet_dispenser_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_tablet_dispenser_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_tablet_dispenser_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_tablet_dispenser_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/leaf-rake-deluxe.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_leaf_rake_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_leaf_rake_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_leaf_rake_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_leaf_rake_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_leaf_rake_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/pool-scoop-net.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_scoop_net_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_scoop_net_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_scoop_net_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_scoop_net_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_scoop_net_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/telescopic-pole.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_telescopic_pole_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_telescopic_pole_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_telescopic_pole_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_telescopic_pole_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_telescopic_pole_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/steel-algae-brush.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_algae_brush_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_algae_brush_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_algae_brush_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_algae_brush_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_algae_brush_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/aluminium-vacuum-head.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_alu_vacuum_head_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_alu_vacuum_head_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_alu_vacuum_head_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_alu_vacuum_head_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_alu_vacuum_head_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/heavy-duty-vacuum-head.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_heavy_vacuum_head_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_heavy_vacuum_head_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_heavy_vacuum_head_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_heavy_vacuum_head_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_heavy_vacuum_head_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/brush-18-inch.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_pool_brush_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_pool_brush_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_pool_brush_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_pool_brush_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_pool_brush_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/vacuum-head-rollers.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_equip_vacuum_brush_rollers_title') }}"
            pool_item_body="{{ __('strings.pool_item_equip_vacuum_brush_rollers_body') }}"
        >
            <x-slot name="modal">
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_key_features') }}</h4>
                <ul class="list-disc pl-5 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_equip_vacuum_brush_rollers_feature_1') }}</li>
                    <li>{{ __('strings.pool_item_equip_vacuum_brush_rollers_feature_2') }}</li>
                    <li>{{ __('strings.pool_item_equip_vacuum_brush_rollers_feature_3') }}</li>
                </ul>
            </x-slot>
        </x-pool-supplies.pool-item-card>

    </div>
</section>

{{-- POOL CHEMICALS --}}
<section id="chemicals" class="scroll-mt-20 mb-16">
    <x-reusables.pill-text>{{ __('strings.pool_item_chem_pill') }}</x-reusables.pill-text>
    <h2 class="aquarius-subheading mb-3!">{{ __('strings.pool_item_chem_title') }}</h2>
    <p class="mb-8 text-neutral-600">{{ __('strings.pool_item_chem_body') }}</p>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 gap-6">

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/chlorine-90.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_chem_chlorine_90_title') }}"
            pool_item_body="{{ __('strings.pool_item_chem_chlorine_90_body') }}"
        >
            <x-slot name="modal">
                <p class="modal-item-subtitle text-base lg:text-lg font-semibold text-primary-600 mb-6">{{ __('strings.pool_item_chem_chlorine_90_subtitle') }}</p>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_why_use') }}</h4>
                <ul class="list-disc pl-5 mb-6 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_chem_chlorine_90_why_1') }}</li>
                    <li>{{ __('strings.pool_item_chem_chlorine_90_why_2') }}</li>
                    <li>{{ __('strings.pool_item_chem_chlorine_90_why_3') }}</li>
                </ul>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_how_to_use') }}</h4>
                <p class="text-neutral-700 mb-5 text-base lg:text-lg leading-relaxed">{{ __('strings.pool_item_chem_chlorine_90_how') }}</p>
                <x-reusables.alert>
                    <span class="font-semibold">{{ __('strings.modal_packaging') }}:</span> {{ __('strings.pool_item_chem_chlorine_90_packaging') }}
                </x-reusables.alert>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/chlorine-90-copper.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_chem_chlorine_90_copper_title') }}"
            pool_item_body="{{ __('strings.pool_item_chem_chlorine_90_copper_body') }}"
        >
            <x-slot name="modal">
                <p class="modal-item-subtitle text-base lg:text-lg font-semibold text-primary-600 mb-6">{{ __('strings.pool_item_chem_chlorine_90_copper_subtitle') }}</p>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_why_use') }}</h4>
                <ul class="list-disc pl-5 mb-6 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_chem_chlorine_90_copper_why_1') }}</li>
                    <li>{{ __('strings.pool_item_chem_chlorine_90_copper_why_2') }}</li>
                    <li>{{ __('strings.pool_item_chem_chlorine_90_copper_why_3') }}</li>
                </ul>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_how_to_use') }}</h4>
                <p class="text-neutral-700 mb-5 text-base lg:text-lg leading-relaxed">{{ __('strings.pool_item_chem_chlorine_90_copper_how') }}</p>
                <x-reusables.alert>
                    <span class="font-semibold">{{ __('strings.modal_packaging') }}:</span> {{ __('strings.pool_item_chem_chlorine_90_copper_packaging') }}
                </x-reusables.alert>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/chlorine-70.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_chem_chlorine_70_title') }}"
            pool_item_body="{{ __('strings.pool_item_chem_chlorine_70_body') }}"
        >
            <x-slot name="modal">
                <p class="modal-item-subtitle text-base lg:text-lg font-semibold text-primary-600 mb-6">{{ __('strings.pool_item_chem_chlorine_70_subtitle') }}</p>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_why_use') }}</h4>
                <ul class="list-disc pl-5 mb-6 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_chem_chlorine_70_why_1') }}</li>
                    <li>{{ __('strings.pool_item_chem_chlorine_70_why_2') }}</li>
                    <li>{{ __('strings.pool_item_chem_chlorine_70_why_3') }}</li>
                </ul>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_how_to_use') }}</h4>
                <p class="text-neutral-700 mb-5 text-base lg:text-lg leading-relaxed">{{ __('strings.pool_item_chem_chlorine_70_how') }}</p>
                <x-reusables.alert>
                    <span class="font-semibold">{{ __('strings.modal_packaging') }}:</span> {{ __('strings.pool_item_chem_chlorine_70_packaging') }}
                </x-reusables.alert>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/ph-up.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_chem_ph_up_title') }}"
            pool_item_body="{{ __('strings.pool_item_chem_ph_up_body') }}"
        >
            <x-slot name="modal">
                <p class="modal-item-subtitle text-base lg:text-lg font-semibold text-primary-600 mb-6">{{ __('strings.pool_item_chem_ph_up_subtitle') }}</p>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_why_use') }}</h4>
                <ul class="list-disc pl-5 mb-6 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_chem_ph_up_why_1') }}</li>
                    <li>{{ __('strings.pool_item_chem_ph_up_why_2') }}</li>
                    <li>{{ __('strings.pool_item_chem_ph_up_why_3') }}</li>
                </ul>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_how_to_use') }}</h4>
                <p class="text-neutral-700 mb-5 text-base lg:text-lg leading-relaxed">{{ __('strings.pool_item_chem_ph_up_how') }}</p>
                <x-reusables.alert>
                    <span class="font-semibold">{{ __('strings.modal_packaging') }}:</span> {{ __('strings.pool_item_chem_ph_up_packaging') }}
                </x-reusables.alert>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/ph-minus.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_chem_ph_minus_title') }}"
            pool_item_body="{{ __('strings.pool_item_chem_ph_minus_body') }}"
        >
            <x-slot name="modal">
                <p class="modal-item-subtitle text-base lg:text-lg font-semibold text-primary-600 mb-6">{{ __('strings.pool_item_chem_ph_minus_subtitle') }}</p>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_why_use') }}</h4>
                <ul class="list-disc pl-5 mb-6 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_chem_ph_minus_why_1') }}</li>
                    <li>{{ __('strings.pool_item_chem_ph_minus_why_2') }}</li>
                    <li>{{ __('strings.pool_item_chem_ph_minus_why_3') }}</li>
                </ul>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_how_to_use') }}</h4>
                <p class="text-neutral-700 mb-5 text-base lg:text-lg leading-relaxed">{{ __('strings.pool_item_chem_ph_minus_how') }}</p>
                <x-reusables.alert>
                    <span class="font-semibold">{{ __('strings.modal_packaging') }}:</span> {{ __('strings.pool_item_chem_ph_minus_packaging') }}
                </x-reusables.alert>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/algaecide.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_chem_algaecide_title') }}"
            pool_item_body="{{ __('strings.pool_item_chem_algaecide_body') }}"
        >
            <x-slot name="modal">
                <p class="modal-item-subtitle text-base lg:text-lg font-semibold text-primary-600 mb-6">{{ __('strings.pool_item_chem_algaecide_subtitle') }}</p>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_why_use') }}</h4>
                <ul class="list-disc pl-5 mb-6 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_chem_algaecide_why_1') }}</li>
                    <li>{{ __('strings.pool_item_chem_algaecide_why_2') }}</li>
                    <li>{{ __('strings.pool_item_chem_algaecide_why_3') }}</li>
                </ul>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_how_to_use') }}</h4>
                <p class="text-neutral-700 text-base lg:text-lg leading-relaxed">{{ __('strings.pool_item_chem_algaecide_how') }}</p>
            </x-slot>
        </x-pool-supplies.pool-item-card>

        <x-pool-supplies.pool-item-card
            pool_item_image="{{ asset('assets/images/pool-items/alum.jpg') }}"
            pool_item_title="{{ __('strings.pool_item_chem_alum_title') }}"
            pool_item_body="{{ __('strings.pool_item_chem_alum_body') }}"
        >
            <x-slot name="modal">
                <p class="modal-item-subtitle text-base lg:text-lg font-semibold text-primary-600 mb-6">{{ __('strings.pool_item_chem_alum_subtitle') }}</p>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_why_use') }}</h4>
                <ul class="list-disc pl-5 mb-6 space-y-1.5 text-neutral-700">
                    <li>{{ __('strings.pool_item_chem_alum_why_1') }}</li>
                    <li>{{ __('strings.pool_item_chem_alum_why_2') }}</li>
                    <li>{{ __('strings.pool_item_chem_alum_why_3') }}</li>
                </ul>
                <h4 class="modal-feature-heading font-heading font-semibold text-lg lg:text-xl text-primary-900 mb-3">{{ __('strings.modal_how_to_use') }}</h4>
                <p class="text-neutral-700 mb-5 text-base lg:text-lg leading-relaxed">{{ __('strings.pool_item_chem_alum_how') }}</p>
                <x-reusables.alert>
                    {{ __('strings.pool_item_chem_alum_packaging') }}
                </x-reusables.alert>
            </x-slot>
        </x-pool-supplies.pool-item-card>

    </div>
</section>

{{-- CLOSING --}}
<div class="mt-8 p-6">
    <p class="mb-2">{{ __('strings.pool_item_closing_1') }}</p>
    <p class="mb-0">{{ __('strings.pool_item_closing_2') }}</p>
</div>

@endsection
