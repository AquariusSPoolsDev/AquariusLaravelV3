@php
use App\Models\ImageGallery;
$images = ImageGallery::where('is_published', 1)->where('is_featured', 1)->orderBy('created_at', 'desc')->take(9)->get();
@endphp

<section id="showcase" class="bg-primary-50/50">
    <div class="main-container">
        <div class="max-w-2xl mx-auto text-center">
            <x-reusables.pill-text class="block" data-animate data-delay="0">{{__('strings.homepage_showcase_pill')}}</x-reusables.pill-text>
            <h2 class="aquarius-homepage-heading" data-animate data-delay="100">{{__('strings.showcase_heading')}}</h2>
        </div>

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
                <svg class="size-5 transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
            </a>
        </div>
        @endif
    </div>
</section>
