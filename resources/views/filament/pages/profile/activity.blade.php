<dl class="grid grid-cols-2 gap-4">
    <div class="flex flex-col gap-1 rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <dt class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
            <x-filament::icon icon="heroicon-o-photo" class="size-4" />
            Images uploaded
        </dt>
        <dd class="text-2xl font-semibold text-gray-950 dark:text-white">{{ $imageCount }}</dd>
    </div>
    <div class="flex flex-col gap-1 rounded-lg bg-gray-50 p-4 dark:bg-white/5">
        <dt class="flex items-center gap-2 text-sm text-gray-500 dark:text-gray-400">
            <x-filament::icon icon="heroicon-o-megaphone" class="size-4" />
            Promotions created
        </dt>
        <dd class="text-2xl font-semibold text-gray-950 dark:text-white">{{ $promotionCount }}</dd>
    </div>
</dl>
