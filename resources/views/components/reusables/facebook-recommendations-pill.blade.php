@props([
    'recommended' => 0,
    'total' => 0,
    'variant' => 'light', {{-- 'light' or 'dark' --}}
])

@php
$wrapClass    = $variant === 'dark'
    ? 'border-primary-600 bg-primary-700/50'
    : 'border-neutral-200 bg-white';

$dividerClass = $variant === 'dark' ? 'bg-primary-500' : 'bg-neutral-200';
$labelClass   = $variant === 'dark' ? 'text-white font-semibold text-sm' : 'text-neutral-700 font-semibold text-sm';
$countClass   = $variant === 'dark' ? 'text-white font-extrabold text-2xl' : 'text-neutral-900 font-extrabold text-2xl';
$totalClass   = $variant === 'dark' ? 'text-primary-200 text-sm' : 'text-neutral-500 text-sm';
$strongClass  = $variant === 'dark' ? 'text-white' : 'text-neutral-900';
@endphp

<div class="inline-flex items-center gap-4 border rounded-full px-6 py-2.5 {{ $wrapClass }}">
    <div class="flex items-center gap-2">
        {{-- Facebook logo --}}
        <svg class="size-5 shrink-0" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg">
            <path d="M24 12.073C24 5.405 18.627 0 12 0S0 5.405 0 12.073C0 18.1 4.388 23.094 10.125 24v-8.437H7.078v-3.49h3.047V9.41c0-3.025 1.792-4.697 4.533-4.697 1.313 0 2.686.236 2.686.236v2.97h-1.513c-1.491 0-1.956.93-1.956 1.886v2.267h3.328l-.532 3.49h-2.796V24C19.612 23.094 24 18.1 24 12.073z" fill="#1877F2"/>
        </svg>
        <span class="{{ $labelClass }}">Facebook</span>
    </div>
    <div class="w-px h-6 {{ $dividerClass }}"></div>
    <div class="flex items-center gap-1.5">
        {{-- Thumbs up --}}
        <svg class="size-5 text-primary shrink-0" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="currentColor">
            <path d="M7.493 18.5c-.425 0-.82-.236-.975-.632A7.48 7.48 0 0 1 6 15.125c0-1.75.599-3.358 1.602-4.634.151-.192.373-.309.6-.397.473-.183.89-.514 1.212-.924a9.042 9.042 0 0 1 2.861-2.4c.723-.384 1.35-.956 1.653-1.715a4.498 4.498 0 0 0 .322-1.672V3a.75.75 0 0 1 .75-.75 2.25 2.25 0 0 1 2.25 2.25c0 1.152-.26 2.243-.723 3.218-.266.558.107 1.282.725 1.282h3.126c1.026 0 1.945.694 2.054 1.715.045.422.068.85.068 1.285a11.95 11.95 0 0 1-2.649 7.521c-.388.482-.987.729-1.605.729H14.23c-.483 0-.964-.078-1.423-.23l-3.114-1.04a4.501 4.501 0 0 0-1.423-.23h-.777ZM2.331 10.727a11.969 11.969 0 0 0-.831 4.398 12 12 0 0 0 .52 3.507C2.28 19.482 3.105 20 3.994 20H4.9c.445 0 .72-.498.523-.898a8.963 8.963 0 0 1-.924-3.977c0-1.708.476-3.305 1.302-4.666.245-.403-.028-.959-.5-.959H4.25c-.832 0-1.612.453-1.918 1.227Z" />
        </svg>
        <span class="{{ $countClass }}">{{ $recommended }}/{{ $total }}</span>
    </div>
    <div class="w-px h-6 {{ $dividerClass }}"></div>
    <span class="{{ $totalClass }}">{{ __('strings.reviews_fb_recommended') }}</span>
</div>
