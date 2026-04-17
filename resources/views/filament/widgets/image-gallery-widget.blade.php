<x-filament-widgets::widget>
    <x-filament::section>
        <div>
            <h2 class="text-xl font-bold mb-2">Image Gallery Showcase Content</h2>

            <div class="mb-4 mt-2">
                <h3 class="font-semibold text-lg mb-1">Stats</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <div>
                        <h4 class="text-gray-500 dark:text-gray-400 text-sm">Total Images Uploaded</h4>
                        <p class="text-4xl font-semibold text-primary-600 dark:text-primary-400">{{ $this->getImagesCount() }}</p>
                    </div>

                    <div>
                        <h4 class="text-gray-500 dark:text-gray-400 text-sm">Published Images</h4>
                        <p class="text-4xl font-semibold text-success-300 dark:text-success-200">{{ $this->getPublishedImages() }}</p>
                    </div>

                    <div>
                        <h4 class="text-gray-500 dark:text-gray-400 text-sm">Unpublished Images (Please check them!)</h4>
                        <p class="text-4xl font-semibold text-error-300 dark:text-error-200">{{ $this->getUnpublishedImages() }}</p>
                    </div>
                </div>
            </div>

            <div class="my-4">
                <h3 class="font-semibold text-lg mb-1">Recent Images</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 lg:grid-cols-5 gap-4 mt-2">
                    @foreach ($this->getRecentImages() as $image)
                    <div>
                        <img class="w-full h-40 object-cover rounded-xl" src="{{ asset('storage/image_gallery/' . $image->image_path) }}" alt="{{ $image->image_name }}" title="{{ $image->image_name }}" />
                        <p class="text-sm mt-1">🖼️ {{ $image->created_at->timezone('Asia/Kuala_Lumpur')->format('d/m/Y H:i') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-4">
                <h3 class="font-semibold text-lg mb-1">Tags Usage Count</h3>
                @php $tagsCount = $this->getTagsCount(); @endphp

                @foreach ($tagsCount as $tag)
                <span class="inline-flex items-center gap-x-2 py-1 px-2.5 mr-1 mb-1 rounded-full text-xs font-medium border border-gray-300 dark:border-gray-600 text-gray-800 dark:text-white">
                    {{ $tag->tag }}
                    <span class="inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium text-white bg-primary-600">{{ $tag->count }}</span>
                </span>
                @endforeach
            </div>
        </div>
    </x-filament::section>
</x-filament-widgets::widget>
