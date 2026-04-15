<section id="compare" class="pt-6 mt-6">
    <x-reusables.pill-text>{{__('strings.our_pools_comparison_pill')}}</x-reusables.pill-text>
    <x-reusables.subheading class="uppercase">
        {{__('strings.pool_comparasion_title_heading')}}
    </x-reusables.subheading>
    <x-pool-comparison-table>
        {{-- Installation --}}
        <x-pool-comparison-table-row
            table_keypoint_title="{{__('strings.table_keypoint_title_1')}}"
            table_concrete_body="{!!__('strings.table_concrete_body_1')!!}"
            table_vinyl_body="{!!__('strings.table_vinyl_body_1')!!}"
            table_fibreglass_body="{!!__('strings.table_fibreglass_body_1')!!}"
        />

        {{-- Finishing --}}
        <x-pool-comparison-table-row
            table_keypoint_title="{{__('strings.table_keypoint_title_2')}}"
            table_concrete_body="{!!__('strings.table_concrete_body_2')!!}"
            table_vinyl_body="{!!__('strings.table_vinyl_body_2')!!}"
            table_fibreglass_body="{!!__('strings.table_fibreglass_body_2')!!}"
        />

        {{-- Durability --}}
        <x-pool-comparison-table-row
            table_keypoint_title="{{__('strings.table_keypoint_title_3')}}"
            table_concrete_body="{!!__('strings.table_concrete_body_3')!!}"
            table_vinyl_body="{!!__('strings.table_vinyl_body_3')!!}"
            table_fibreglass_body="{!!__('strings.table_fibreglass_body_3')!!}"
        />

        {{-- Attractiveness --}}
        <x-pool-comparison-table-row
            table_keypoint_title="{{__('strings.table_keypoint_title_4')}}"
            table_concrete_body="{!!__('strings.table_concrete_body_4')!!}"
            table_vinyl_body="{!!__('strings.table_vinyl_body_4')!!}"
            table_fibreglass_body="{!!__('strings.table_fibreglass_body_4')!!}"
        />

        {{-- Initial cost --}}
        <x-pool-comparison-table-row
            table_keypoint_title="{{__('strings.table_keypoint_title_5')}}"
            table_concrete_body="{!!__('strings.table_concrete_body_5')!!}"
            table_vinyl_body="{!!__('strings.table_vinyl_body_5')!!}"
            table_fibreglass_body="{!!__('strings.table_fibreglass_body_5')!!}"
        />

        {{-- Customization --}}
        <x-pool-comparison-table-row
            table_keypoint_title="{{__('strings.table_keypoint_title_6')}}"
            table_concrete_body="{!!__('strings.table_concrete_body_6')!!}"
            table_vinyl_body="{!!__('strings.table_vinyl_body_6')!!}"
            table_fibreglass_body="{!!__('strings.table_fibreglass_body_6')!!}"
        />

        {{-- Portability --}}
        <x-pool-comparison-table-row
            table_keypoint_title="{{__('strings.table_keypoint_title_7')}}"
            table_concrete_body="{!!__('strings.table_concrete_body_7')!!}"
            table_vinyl_body="{!!__('strings.table_vinyl_body_7')!!}"
            table_fibreglass_body="{!!__('strings.table_fibreglass_body_7')!!}"
        />

        {{-- Benefits --}}
        <x-pool-comparison-table-row
            table_keypoint_title="{{__('strings.table_keypoint_title_8')}}"
            table_concrete_body="{!!__('strings.table_concrete_body_8')!!}"
            table_vinyl_body="{!!__('strings.table_vinyl_body_8')!!}"
            table_fibreglass_body="{!!__('strings.table_fibreglass_body_8')!!}"
        />

        {{-- Limitations --}}
        <x-pool-comparison-table-row
            table_keypoint_title="{{__('strings.table_keypoint_title_9')}}"
            table_concrete_body="{!!__('strings.table_concrete_body_9')!!}"
            table_vinyl_body="{!!__('strings.table_vinyl_body_9')!!}"
            table_fibreglass_body="{!!__('strings.table_fibreglass_body_9')!!}"
        />

        {{-- Summary --}}
        <x-pool-comparison-table-row
            table_keypoint_title="{{__('strings.table_keypoint_title_10')}}"
            table_concrete_body="{!!__('strings.table_concrete_body_10')!!}"
            table_vinyl_body="{!!__('strings.table_vinyl_body_10')!!}"
            table_fibreglass_body="{!!__('strings.table_fibreglass_body_10')!!}"
        />
    </x-pool-comparison-table>
</section>
