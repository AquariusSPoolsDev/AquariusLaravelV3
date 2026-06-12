@props(['variant' => 'light'])

<div {{ $attributes->merge(['class' => 'pill-text' . ($variant === 'dark' ? ' pill-text-dark' : '')]) }}>
    <span>{{ $slot }}</span>
</div>
