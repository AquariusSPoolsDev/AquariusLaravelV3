@foreach($images as $image)
<div class="bg-neutral-50 border-2 border-neutral-200 shadow-sm hover:shadow-lg transition-all rounded-lg overflow-hidden
    hover:border-primary-600 active:border-primary-600 active:scale-97 focus-visible:ring-2 focus-visible:ring-primary focus-visible:outline-none focus-visible:ring-offset-4">

    <a data-fslightbox="{{ $galleryId }}" href="{{ asset('storage/' . $image->image_path) }}">
        <img loading="lazy" src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->image_name }}" title="{{ $image->image_name }}" class="w-full h-60 object-cover">
    </a>
    <div class="sr-only">
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
    </div>
</div>
@endforeach