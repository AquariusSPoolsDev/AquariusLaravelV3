@props(['ogPageTitle' => config('app.name'), 'ogDescription' => '', 'ogImage' => '', 'noIndex' => false])
@php
    // Pages pass these through {{ }} already; decode once so the {{ }} below escapes exactly once
    // (otherwise "&" and "'" show up as "&amp;amp;" / "&amp;#039;" in Google and social previews).
    $ogPageTitle = html_entity_decode((string) $ogPageTitle, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $ogDescription = html_entity_decode((string) $ogDescription, ENT_QUOTES | ENT_HTML5, 'UTF-8');
    $ogImage = html_entity_decode((string) $ogImage, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    // Keep titles short (~50-65 chars) so Google shows them in full: "<page topic> | <brand>".
    $brandName = 'Aquarius Swimming Pools';
    if (Route::currentRouteName() === 'homepage') {
        $ogPageTitle = __('strings.homepage_seo_title');
    }
    $ogSiteTitle = str_contains($ogPageTitle, 'Aquarius') ? $ogPageTitle : $ogPageTitle.' | '.$brandName;

    // Build hreflang URLs by swapping locale segment
    $currentPath = request()->getPathInfo();
    $enPath = preg_replace('#^/(en|ms)(/|$)#', '/en$2', $currentPath);
    $msPath = preg_replace('#^/(en|ms)(/|$)#', '/ms$2', $currentPath);
    $baseUrl = rtrim(config('app.url'), '/');
    $hreflangEn = $baseUrl . $enPath;
    $hreflangMs = $baseUrl . $msPath;
@endphp
    <title>{{ $ogSiteTitle }}</title>
    <meta name="title" content="{{ $ogSiteTitle }}" />
    <meta name="description" content="{{ $ogDescription }}" />
    <meta name="robots" content="{{ $noIndex ? 'noindex, nofollow' : 'index, follow' }}" />
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