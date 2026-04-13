@props(['pool_type_image','pool_type_name', 'pool_type_desc'])

{{-- CARD --}}
<div class="aquarius-our-pools-card">
    <div class="aquarius-our-pools-card-content">
        <img loading="lazy" class="aquarius-our-pools-card-img"
            src="{{$pool_type_image}}" alt="{{$pool_type_name}} Image">

        <div class="aquarius-our-pools-card-body">
            <div class="flex flex-col justify-center">
                <h3 class="our-pools-type-title">
                    {{$pool_type_name}}
                </h3>
                <p class="mb-0">
                    {{$pool_type_desc}}
                </p>
            </div>
        </div>
    </div>
</div>
{{-- CARD --}}