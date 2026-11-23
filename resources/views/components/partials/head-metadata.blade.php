    {{-- charset must come first (within the first 1024 bytes), before the structured data blocks --}}
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    {{-- Light-only site: keep browser-drawn controls light, and tint the mobile browser bar in brand blue --}}
    <meta name="color-scheme" content="light">
    <meta name="theme-color" content="#3170b9">
    {{-- Sitewide structured data: Organization + WebSite (entity recognition, AI citation) --}}
    <x-seo.organization-schema />
    {{-- Sitewide LocalBusiness schema (local pack, Maps, AI local answers) --}}
    <x-seo.local-business />
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- INCLUDE SEO DATA FROM EVERY PAGES --}}
    @yield('seoData')

    <meta name="google-site-verification" content="m4m8SXHkw6n2F-AMy8oO-CUBZtG1_H-_4A7cBgDujvM" />

    {{-- Fonts V3.0 --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=figtree:400,500,600,700,800|outfit:400,500,600,700,800" rel="stylesheet" />
    
    {{-- Slider (Swiper) screen-reader messages in the page language, read by resources/js/app.js --}}
    <script type="application/json" id="swiper-a11y-messages">{!! json_encode([
        'prevSlideMessage' => __('strings.slider_prev'),
        'nextSlideMessage' => __('strings.slider_next'),
        'firstSlideMessage' => __('strings.slider_first'),
        'lastSlideMessage' => __('strings.slider_last'),
        'paginationBulletMessage' => __('strings.slider_go_to'),
        'slideLabelMessage' => __('strings.slider_label'),
    ], JSON_HEX_TAG | JSON_UNESCAPED_UNICODE) !!}</script>

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])



    {{-- FAVICON --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/aquarius-logo-navbar.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">
    
    <!-- Google Tag Manager — loaded conditionally after cookie consent -->
    <script>
        function aquariusLoadGTM() {
            (function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
            new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
            j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
            'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
            })(window,document,'script','dataLayer','GTM-PH2GPHF');
        }
        if (document.cookie.split(';').some(function(c){ return c.trim().startsWith('aquarius_cookie_consent=accepted'); })) {
            aquariusLoadGTM();
        }
    </script>
    <!-- End Google Tag Manager -->

    <!-- Google tag (gtag.js) -->
    <!--<script async src="https://www.googletagmanager.com/gtag/js?id=AW-845575285"></script>-->
    <!--<script>-->
    <!--  window.dataLayer = window.dataLayer || [];-->
    <!--  function gtag(){dataLayer.push(arguments);}-->
    <!--  gtag('js', new Date());-->
    
    <!--  gtag('config', 'AW-845575285');-->
    <!--</script>-->
