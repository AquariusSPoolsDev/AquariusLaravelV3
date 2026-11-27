@foreach($images as $image)
<div class="bg-neutral-50 border-2 border-neutral-200 rounded-lg overflow-hidden transition-all duration-200 hover:outline-3 hover:-outline-offset-3 hover:outline-primary-600 active:scale-97">

    <a data-fslightbox="{{ $galleryId }}" href="{{ asset('storage/image_gallery/' . $image->image_path) }}">
        {{-- Small copy in the grid; the link above opens the full photo --}}
        <img loading="lazy" decoding="async" src="{{ $image->thumbnailUrl() }}" alt="{{ $image->image_name }}" class="w-full h-60 object-cover">
    </a>
    <div class="sr-only">
        <h3 class="font-semibold text-lg text-neutral-800">{{ $image->image_name }}</h3>
        <p class="text-base text-neutral-600">{{ $image->image_description }}</p>
        
        @if($image->image_tags)
        <div class="mt-2 flex flex-wrap">
            @foreach($image->image_tags as $tag)
            <span class="bg-primary-50 text-primary-950 text-xs px-2 py-1 rounded-md mr-1 mb-1">
                {{ $tag }}
            </span>
            @endforeach
        </div>
        @endif
    </div>
</div>
@endforeach