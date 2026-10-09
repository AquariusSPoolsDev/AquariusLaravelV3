<x-filament-widgets::widget>
    <x-filament::section heading="Showcase gallery" description="Latest uploads">
        <x-slot name="afterHeader">
            <x-filament::link :href="$galleryUrl" size="sm">Open gallery</x-filament::link>
        </x-slot>

        <div class="flex flex-col gap-6">
            @if ($recentImages->isNotEmpty())
                <div class="grid grid-cols-3 gap-2 sm:grid-cols-5">
                    @foreach ($recentImages as $image)
                        <img
                            class="aspect-square w-full rounded-lg object-cover"
                            src="{{ asset('storage/image_gallery/' . $image->image_path) }}"
                            alt="{{ $image->image_name }}"
                            title="{{ $image->image_name }} · {{ $image->created_at->timezone('Asia/Kuala_Lumpur')->format('d M Y, g:i A') }}"
                            loading="lazy"
                        />
                    @endforeach
                </div>
            @else
                <p class="text-sm text-gray-500 dark:text-gray-400">No images uploaded yet.</p>
            @endif

            @if ($tagCounts->isNotEmpty())
                <div x-data="{ showAllTags: false }" class="flex flex-col gap-2">
                    <div class="flex justify-between gap-2 text-sm">
                        <h3 class="font-semibold text-gray-500 dark:text-gray-400">
                            <span x-show="! showAllTags">Top tags</span>
                            <span x-show="showAllTags" x-cloak>All tags</span>
                        </h3>
                        @if ($tagCounts->count() > $visibleTagLimit)
                            <button
                                type="button"
                                x-on:click="showAllTags = ! showAllTags"
                                x-bind:aria-expanded="showAllTags"
                                class="font-semibold text-primary-600 hover:underline dark:text-primary-400"
                            >
                                <span x-show="! showAllTags">{{ $tagCounts->count() }} tags in use · Show all</span>
                                <span x-show="showAllTags" x-cloak>Show less</span>
                            </button>
                        @else
                            <span class="text-gray-500 dark:text-gray-400">{{ $tagCounts->count() }} tags in use</span>
                        @endif
                    </div>
                    <div class="flex flex-wrap gap-1.5">
                        @foreach ($tagCounts as $tag => $count)
                            <x-filament::badge
                                color="gray"
                                :x-show="$loop->index >= $visibleTagLimit ? 'showAllTags' : null"
                                :x-cloak="$loop->index >= $visibleTagLimit"
                            >
                                {{ $tag }}
                                <span class="ms-1 text-primary-600 dark:text-primary-400">{{ $count }}</span>
                            </x-filament::badge>
                        @endforeach
                    </div>
                </div>
            @endif
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
