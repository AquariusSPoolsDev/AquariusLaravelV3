@props(['pool_item_image','pool_item_title', 'pool_item_body'])

{{-- CARD --}}
<div class="pool-item-card">
    <div class="lg:relative block lg:flex items-center overflow-hidden h-[inherit]">
        <img class="w-full h-60 lg:w-56 lg:h-full lg:absolute inset-0 object-cover !m-0"
            src="{{$pool_item_image}}" alt="{{$pool_item_title}}">

        <div class="grow p-4 max-lg:mt-3 lg:ms-60">
            <div class="flex flex-col justify-center">
                <h3 class="font-semibold mt-0 pool-item-title-secondary">
                    {{$pool_item_title}}
                </h3>
                <p class="mb-0">
                    {{$pool_item_body}}
                </p>
            </div>
        </div>
    </div>
</div>
{{-- CARD --}}