@php
use App\Models\ImageGallery;
$images = ImageGallery::where('is_published', 1)->where('is_featured', 1)->orderBy('created_at', 'desc')->take(9)->get();
@endphp

<section id="showcase" class="bg-primary-50/50">
    <div class="main-container">
        <h2 class="aquarius-homepage-heading" data-animate data-delay="0">{{__('strings.showcase_heading')}}</h2>

        @if($images->count() === 9)
        <div class="aquarius-homepage-showcase-grid">
            @foreach ($images as $image)
                <a href="{{ route('pool-showcase-gallery') }}"
                    data-animate data-delay="{{ $loop->index * 60 }}"
                    class="showcase-grid-content
                    {{ $loop->index + 1 === 2 || $loop->index + 1 === 8 ? 'wide-col-content' : '' }}
                    {{ $loop->index + 1 === 4 || $loop->index + 1 === 7 ? 'start-row-3-content' : '' }}
                    {{ $loop->index + 1 === 5 ? 'middle-content' : '' }}">
                    <img loading="lazy" src="{{ asset('storage/image_gallery/' . $image->image_path) }}" alt="{{ $image->image_name }}" title="{{ $image->image_name }}">
                </a>
            @endforeach
        </div>

        <div class="mt-10 text-center" data-animate data-delay="580">
            <a href="{{ route('pool-showcase-gallery') }}" class="aquarius-showcase-btn group">
                {{__('strings.showcase_btn_gallery')}}
                <svg class="size-5 transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
                    <path d="M5 12h14"/><path d="m12 5 7 7-7 7"/>
                </svg>
            </a>
        </div>
        @endif
    </div>
</section>
