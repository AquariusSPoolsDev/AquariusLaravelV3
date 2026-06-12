    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    {{-- INCLUDE SEO DATA FROM EVERY PAGES --}}
    @yield('seoData')

    <meta name="robots" content="index, follow">
    <meta name="google-site-verification" content="m4m8SXHkw6n2F-AMy8oO-CUBZtG1_H-_4A7cBgDujvM" />

    {{-- Fonts V3.0 --}}
    <link rel="preconnect" href="https://fonts.bunny.net">
    <link href="https://fonts.bunny.net/css?family=lato:300,400,700|outfit:300,400,500,600,700,800|playfair-display:400" rel="stylesheet" />
    
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
