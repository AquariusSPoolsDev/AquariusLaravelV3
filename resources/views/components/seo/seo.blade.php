@props(['ogPageTitle' => config('app.name'), 'ogDescription' => '', 'ogImage' => '', 'noIndex' => false])
@php
    $ogSiteTitle = Route::currentRouteName() === 'homepage'
        ? 'Johor Bahru (JB) Swimming Pool Builder and Contractor Specialist | Aquarius Swimming Pools'
        : $ogPageTitle . ' | Johor Bahru (JB) Swimming Pool Specialist | Aquarius Swimming Pools';

    // Build hreflang URLs by swapping locale segment
    $currentPath = request()->getPathInfo();
    $enPath = preg_replace('#^/(en|ms)(/|$)#', '/en$2', $currentPath);
    $msPath = preg_replace('#^/(en|ms)(/|$)#', '/ms$2', $currentPath);
    $baseUrl = rtrim(config('app.url'), '/');
    $hreflangEn = $baseUrl . $enPath;
    $hreflangMs = $baseUrl . $msPath;
@endphp
    <title>{!! $ogSiteTitle !!}</title>
    <meta name="title" content="{{ $ogSiteTitle }}" />
    <meta name="description" content="{{ $ogDescription }}" />
    @if($noIndex)
    <meta name="robots" content="noindex, nofollow" />
    @endif
    <link rel="canonical" href="{{ url()->current() }}" />
    <link rel="alternate" hreflang="en" href="{{ $hreflangEn }}" />
    <link rel="alternate" hreflang="ms" href="{{ $hreflangMs }}" />
    <link rel="alternate" hreflang="x-default" href="{{ $hreflangEn }}" />

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