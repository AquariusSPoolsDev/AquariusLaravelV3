@props([
    // 'concrete', 'vinyl' or 'fibreglass': picks the {pool}_pool_step_{n}_title / _description strings
    'pool',
    // [step number => photo path under public/ without extension, or null when there is no photo yet]
    'steps',
])

{{-- One build sequence: each step shows its number, title, description and photo together.
     Photos open full size in the lightbox; a .webp is used when one sits next to the .jpg. --}}
<ol class="pool-process">
    @foreach ($steps as $number => $photo)
        @php
            $title = __("strings.{$pool}_pool_step_{$number}_title");
            $hasPhoto = $photo !== null && file_exists(public_path($photo.'.jpg'));
            $hasWebp = $hasPhoto && file_exists(public_path($photo.'.webp'));
        @endphp
        <li class="pool-process-step" data-animate data-delay="{{ $loop->index * 80 }}">
            <div class="pool-process-marker" aria-hidden="true">
                <span class="pool-process-number">{{ $number }}</span>
                @unless ($loop->last)
                    <span class="pool-process-line"></span>
                @endunless
            </div>

            <div class="pool-process-body {{ $hasPhoto ? 'has-photo' : '' }}">
                <div>
                    <h3 class="pool-process-title">{{ $title }}</h3>
                    <p class="pool-process-desc">{{ __("strings.{$pool}_pool_step_{$number}_description") }}</p>
                </div>

                @if ($hasPhoto)
                    <a href="{{ asset($photo.'.jpg') }}" data-fslightbox="{{ $pool }}-steps" class="pool-process-photo">
                        <picture>
                            @if ($hasWebp)
                                <source srcset="{{ asset($photo.'.webp') }}" type="image/webp">
                            @endif
                            <img src="{{ asset($photo.'.jpg') }}" alt="{{ $number }}. {{ $title }}" loading="lazy">
                        </picture>
                    </a>
                @endif
            </div>
        </li>
    @endforeach
</ol>
