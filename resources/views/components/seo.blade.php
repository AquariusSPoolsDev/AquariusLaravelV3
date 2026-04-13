    <title>{{ $ogSiteTitle }}</title>
    <meta name="title" content="{{ $ogSiteTitle }}" />
    <meta name="description" content="{{ $ogDescription }}" />

    <!-- Open Graph / Facebook -->
    <meta property="og:type" content="website" />
    <meta property="og:url" content="{{ url()->current() }}" />
    <meta property="og:title" content="{{ $ogSiteTitle }}" />
    <meta property="og:description" content="{{ $ogDescription }}" />
    <meta property="og:image" content="{{ $ogImage }}" />

    <!-- Twitter -->
    <meta property="twitter:card" content="summary_large_image" />
    <meta property="twitter:url" content="{{ url()->current() }}" />
    <meta property="twitter:title" content="{{ $ogSiteTitle }}" />
    <meta property="twitter:description" content="{{ $ogDescription }}" />
    <meta property="twitter:image" content="{{ $ogImage }}" />