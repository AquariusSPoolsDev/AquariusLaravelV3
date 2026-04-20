@props(['lang'])

@php
    $filenames = [
        'en_MY' => 'eng',
        'ms_MY' => 'msa',
    ];

    $file = $filenames[$lang] ?? 'msa';
    $path = public_path("assets/svgs/{$file}.svg");
@endphp

<span {{ $attributes->merge(['class' => 'w-5 h-auto']) }}>
    @if(file_exists($path))
        {!! file_get_contents($path) !!}
    @else
        <small>[Flag Missing]</small>
    @endif
</span>