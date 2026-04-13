<x-filament-widgets::widget>
    <x-filament::section>
        <div>
            <h2 class="text-xl font-bold mb-2">Image Gallery Showcase Content</h2>

            <div class="mb-4 mt-2">
                <h3 class="font-semibold text-lg" style="margin-bottom: 0.25rem">Stats</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <style>
                        .text-green-600 {
                            --tw-text-opacity: 1;
                            color: rgb(22 163 74 / var(--tw-text-opacity, 1)) /* #16a34a */;
                        }

                        .dark\:text-green-400:is(.dark *) {
                            --tw-text-opacity: 1;
                            color: rgb(74 222 128 / var(--tw-text-opacity, 1)) /* #4ade80 */;
                        }

                        .text-red-600 {
                            --tw-text-opacity: 1;
                            color: rgb(220 38 38 / var(--tw-text-opacity, 1)) /* #dc2626 */;
                        }

                        .dark\:text-red-400:is(.dark *) {
                            --tw-text-opacity: 1;
                            color: rgb(248 113 113 / var(--tw-text-opacity, 1)) /* #f87171 */;
                        }
                    </style>
                    <div class="">
                        <h4 class="text-gray-500 dark:text-gray-400 text-sm">Total Images Uploaded</h4>
                        <p style="font-size: 2.25rem" class="font-semibold text-primary-600 dark:text-primary-400">{{ $this->getImagesCount() }}</p>
                    </div>

                    <div class="">
                        <h4 class="text-gray-500 dark:text-gray-400 text-sm">Published Images</h4>
                        <p style="font-size: 2.25rem" class="font-semibold text-green-600 dark:text-green-400">{{ $this->getPublishedImages() }}</p>
                    </div>

                    <div class="">
                        <h4 class="text-gray-500 dark:text-gray-400 text-sm">Unpublished Images (Please check them!)</h4>
                        <p style="font-size: 2.25rem" class="font-semibold text-red-600 dark:text-red-400">{{ $this->getUnpublishedImages() }}</p>
                    </div>
                </div>
            </div>
            
            <div class="my-4">
                <style>
                    @media (min-width: 1024px) {
                        .lg-col {
                            grid-template-columns: repeat(5, minmax(0, 1fr));
                        }
                    }
                </style>
                <h3 class="font-semibold text-lg" style="margin-bottom: 0.25rem">Recent Images</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 lg-col gap-4 mt-2">
                    @foreach ($this->getRecentImages() as $image)
                    <div>
                        <img class="w-full object-cover rounded-xl" style="height: 10rem" src="{{ asset('storage/' . $image->image_path) }}" alt="{{$image->image_name}}" title="{{$image->image_name}}"/>
                        <p class="text-sm">🖼️ {{ $image->created_at->timezone('Asia/Kuala_Lumpur')->format('d/m/Y H:i') }}</p>
                    </div>
                    @endforeach
                </div>
            </div>

            <div class="mt-4">
                <h3 class="font-semibold text-lg" style="margin-bottom: 0.25rem">Tags Usage Count</h3>
                @php
                   $tagsCount = $this->getTagsCount(); 
                @endphp
                
                @foreach ($tagsCount as $tag)
                <div style="margin-right: 0.25rem; margin-bottom: 0.25rem;" class="inline-flex items-center gap-x-2 py-1 px-2.5 rounded-full text-xs font-medium border border-gray-800 text-gray-800 dark:border-gray-600 dark:text-white">
                    {{$tag->tag}} <span class="inline-flex items-center py-0.5 px-1.5 rounded-full text-xs font-medium text-white" style="background-color: #3b82f6">{{$tag->count}}</span>
                </div>
                @endforeach
            </div>
        </div>        
    </x-filament::section>
</x-filament-widgets::widget>
