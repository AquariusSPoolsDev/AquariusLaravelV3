@foreach($images as $image)
<div class="bg-gray-50 border border-gray-200 shadow-sm hover:shadow-lg transition-all rounded-xl overflow-hidden">
    <a data-fslightbox="{{ $galleryId }}" href="{{ asset('storage/' . $image->image_path) }}">
    <img loading="lazy" src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->image_name }}" title="{{ $image->image_name }}" class="w-full h-60 object-cover">
    </a>
    {{-- <div class="p-4">
        <h3 class="font-semibold text-lg text-gray-800">{{ $image->image_name }}</h3>
        <p class="text-sm text-gray-600">{{ $image->image_description }}</p>
        
        @if($image->image_tags)
        <div class="mt-2 flex flex-wrap">
            @foreach($image->image_tags as $tag)
            <span class="bg-primary-50 text-primary-950 text-xs px-2 py-1 rounded-md mr-1 mb-1">
                {{ $tag }}
            </span>
            @endforeach
        </div>
        @endif
    </div> --}}
</div>
@endforeach