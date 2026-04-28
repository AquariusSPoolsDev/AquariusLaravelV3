@props(['pool_item_image', 'pool_item_title', 'pool_item_brief'])

<div class="pool-item-card flex flex-col">
    <div class="h-52 overflow-hidden">
        <img class="w-full h-full object-cover m-0" src="{{ $pool_item_image }}" alt="{{ $pool_item_title }}">
    </div>
    <div class="flex flex-col flex-1 p-5">
        <h3 class="font-semibold text-lg text-primary-800 mt-0 mb-2">
            {{ $pool_item_title }}
        </h3>
        <p class="text-neutral-600 leading-relaxed mb-0">
            {{ $pool_item_brief }}
        </p>
    </div>
</div>
