@props([
    'color' => 'info',
])

@php
$colorMap = [
    'success'   => 'bg-success-100 text-success-400 border-success-200',
    'error'     => 'bg-error-100 text-error-400 border-error-200',
    'warning'   => 'bg-warning-100 text-warning-400 border-warning-200',
    'info'      => 'bg-primary-50 text-primary-800 border-primary-100',
];

$classes = $colorMap[$color] ?? $colorMap['info'];
@endphp

<div {{ $attributes->merge(['class' => "aquarius-alert $classes"]) }} role="alert">
    {{ $slot }}
</div>