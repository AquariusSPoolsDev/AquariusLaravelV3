@props(['ogPageTitle' => config('app.name'), 'ogDescription' => '', 'ogImage' => ''])
@php
    $ogSiteTitle = Route::currentRouteName() === 'homepage'
        ? 'Johor Bahru (JB) Swimming Pool Builder and Contractor Specialist | Aquarius Swimming Pools'
        : $ogPageTitle . ' | Johor Bahru (JB) Swimming Pool Specialist | Aquarius Swimming Pools';
@endphp
    <title>{!! $ogSiteTitle !!}</title>
    <meta name="title" content="{{ $ogSiteTitle }}" />
    <meta name="description" content="{{ $ogDescription }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $ogPageTitle }}" />
    <meta property="og:description" content="{{ $ogDescription }}" />
    <meta property="og:image" content="{{ $ogImage }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:title" content="{{ $ogPageTitle }}" />
    <meta property="twitter:description" content="{{ $ogDescription }}" />
    <meta property="twitter:image" content="{{ $ogImage }}" />