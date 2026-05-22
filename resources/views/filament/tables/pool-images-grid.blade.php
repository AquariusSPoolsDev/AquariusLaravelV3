<div class="flex flex-wrap gap-4 p-4">
    @foreach ($records as $record)
        @php
            $imageUrl = Storage::disk('public')->url('image_gallery/' . $record->image_path);
            $editUrl = \App\Filament\Resources\ImageGalleryResource::getUrl('edit', ['record' => $record]);
        @endphp
        <a href="{{ $editUrl }}"
           class="group relative overflow-hidden rounded-xl shadow-md hover:shadow-xl transition-shadow duration-200"
           style="width: calc(25% - 12px); min-width: 160px;">
            <img src="{{ $imageUrl }}"
                 alt="{{ $record->image_name }}"
                 class="w-full h-48 object-cover transition-transform duration-200 group-hover:scale-105">
            <span class="absolute top-2 right-2 text-xs font-semibold px-2 py-0.5 rounded-full
                {{ $record->is_published ? 'bg-green-500 text-white' : 'bg-red-500 text-white' }}">
                {{ $record->is_published ? 'Published' : 'Unpublished' }}
            </span>
        </a>
    @endforeach

    @if ($records->isEmpty())
        <div class="w-full text-center text-gray-400 py-12">No images found.</div>
    @endif
</div>
