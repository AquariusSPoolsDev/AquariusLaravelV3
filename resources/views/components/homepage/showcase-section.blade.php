@php
use App\Models\ImageGallery;
$images = ImageGallery::where('is_published', 1)->orderBy('created_at', 'desc')->take(9)->get();
@endphp

<section id="showcase" class="main-container">
    <h2 class="aquarius-homepage-heading">{{__('strings.showcase_heading')}}</h2>

    <div class="aquarius-homepage-showcase-grid">
        @foreach ($images as $image)
            <div class="showcase-grid-content 
                {{ $loop->index + 1 === 2 ||$loop->index + 1 === 8 ? 'wide-col-content' : '' }}
                {{ $loop->index + 1 === 4 || $loop->index + 1 === 7 ? 'start-row-3-content' : '' }}
                {{ $loop->index + 1 === 5 ? 'middle-content' : '' }}">
                <img loading="lazy" src="{{ asset('storage/' . $image->image_path) }}" alt="{{ $image->image_name }}" title="{{ $image->image_name }}">
            </div>
        @endforeach
    </div>
    
    <div class="mt-8 text-center">
        <a href="{{ route('pool-showcase-gallery') }}" type="button" class="aquarius-showcase-btn">
            {{__('strings.showcase_btn_gallery')}}
        </a>
    </div>
</section>
