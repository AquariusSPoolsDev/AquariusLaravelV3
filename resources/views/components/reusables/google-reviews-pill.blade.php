@props([
    'avg' => 0,
    'total' => 0,
    'variant' => 'light', {{-- 'light' or 'dark' --}}
])

@php
$avg = round((float) $avg, 1);

$wrapClass  = $variant === 'dark'
    ? 'border-primary-600 bg-primary-700/50'
    : 'border-neutral-200 bg-white';

$dividerClass = $variant === 'dark' ? 'bg-primary-500' : 'bg-neutral-200';
$labelClass   = $variant === 'dark' ? 'text-white font-semibold text-sm' : 'text-neutral-700 font-semibold text-sm';
$ratingClass  = $variant === 'dark' ? 'text-white' : 'text-neutral-900';
$totalClass   = $variant === 'dark' ? 'text-primary-200 text-sm' : 'text-neutral-500 text-sm';
$strongClass  = $variant === 'dark' ? 'text-white' : 'text-neutral-900';
@endphp

<div class="inline-flex items-center gap-4 border rounded-full px-6 py-2.5 {{ $wrapClass }}">
    <div class="flex items-center gap-2">
        <svg class="size-5 shrink-0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M22.56 12.25c0-.78-.07-1.53-.2-2.25H12v4.26h5.92c-.26 1.37-1.04 2.53-2.21 3.31v2.77h3.57c2.08-1.92 3.28-4.74 3.28-8.09z" fill="#4285F4"/>
            <path d="M12 23c2.97 0 5.46-.98 7.28-2.66l-3.57-2.77c-.98.66-2.23 1.06-3.71 1.06-2.86 0-5.29-1.93-6.16-4.53H2.18v2.84C3.99 20.53 7.7 23 12 23z" fill="#34A853"/>
            <path d="M5.84 14.09c-.22-.66-.35-1.36-.35-2.09s.13-1.43.35-2.09V7.07H2.18C1.43 8.55 1 10.22 1 12s.43 3.45 1.18 4.93l3.66-2.84z" fill="#FBBC05"/>
            <path d="M12 5.38c1.62 0 3.06.56 4.21 1.64l3.15-3.15C17.45 2.09 14.97 1 12 1 7.7 1 3.99 3.47 2.18 7.07l3.66 2.84c.87-2.6 3.3-4.53 6.16-4.53z" fill="#EA4335"/>
        </svg>
        <span class="{{ $labelClass }}">Google Reviews</span>
    </div>
    <div class="w-px h-6 {{ $dividerClass }}"></div>
    <div class="flex items-center gap-2">
        <span class="text-2xl font-extrabold {{ $ratingClass }}">{{ $avg }}</span>
        <span class="text-warning-300 text-2xl leading-none">★</span>
    </div>
    <div class="w-px h-6 {{ $dividerClass }}"></div>
    <span class="{{ $totalClass }}">{!! __('strings.reviews_based_on', ['total' => '<strong class="' . $strongClass . '">' . $total . '</strong>']) !!}</span>
</div>
