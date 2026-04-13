<div class="pool-service-body {{ $isReversed ? 'lg:flex-row-reverse' : '' }}">
    <div class="pool-service-image-side">
        <div class="pool-service-relative">
            <div class="pool-service-absolute">
                <img class="pool-service-img-content" src="{{ asset($image) }}" alt="{!! $title !!}">
            </div>
        </div>
    </div>
    <div class="pool-service-content-side">
        <div>
            <h2 class="pool-service-title">{!! $title !!}</h2>
            @foreach ($content as $paragraph)
                <p>{{ $paragraph }}</p>
            @endforeach
        </div>
    </div>
</div>
