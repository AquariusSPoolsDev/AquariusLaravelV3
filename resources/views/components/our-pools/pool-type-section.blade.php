<section id="" class="mt-12">
    <x-reusables.pill-text>{{__('strings.our_pools_overview_pill')}}</x-reusables.pill-text>
    <x-reusables.subheading class="uppercase">
        {{__('strings.our_pools_overview_title')}}
    </x-reusables.subheading>

    <x-our-pools.pool-types-card 
        pool_type_image="{{ asset('assets/images/our-pools-concrete.jpg') }}"
        pool_type_name="{{__('strings.pools_concrete')}}"
        pool_type_desc="{{__('strings.our_pools_concrete_overview')}}"
    />

    <x-our-pools.pool-types-card 
        pool_type_image="{{ asset('assets/images/our-pools-vinyl.jpg') }}"
        pool_type_name="{{__('strings.pools_vinyl')}}"
        pool_type_desc="{{__('strings.our_pools_vinyl_overview')}}"
    />

    <x-our-pools.pool-types-card 
        pool_type_image="{{ asset('assets/images/our-pools-fibreglass.jpg') }}"
        pool_type_name="{{__('strings.pools_fibreglass')}}"
        pool_type_desc="{{__('strings.our_pools_fibreglass_overview')}}"
    />
</section>