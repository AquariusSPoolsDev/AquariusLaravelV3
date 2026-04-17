    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="robots" content="index, follow" />

    {{-- INCLUDE SEO DATA FROM EVERY PAGES --}}
    @yield('seoData')

    <meta name="robots" content="index, follow">
    <meta name="google-site-verification" content="m4m8SXHkw6n2F-AMy8oO-CUBZtG1_H-_4A7cBgDujvM" />

    <link rel="alternate" hreflang="en" href="{{ url('/en') }}" />
    <link rel="alternate" hreflang="ms" href="{{ url('/ms') }}" />

    {{-- Fonts V3.0 --}}
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Outfit:wght@300;400;500;600;700;800&family=Lato:ital,wght@0,300;0,400;0,700;1,400&display=swap" rel="stylesheet">

    <!-- Styles / Scripts -->
    @vite(['resources/css/app.css', 'resources/js/app.js'])


    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.6.0/css/all.min.css" integrity="sha512-Kc323vGBEqzTmouAECnVceyQqyqdsSiqLQISBL29aUW4U/M7pSPA/gEUZQqv1cwx4OnYxTxve5UMg5GT6L4JJg==" crossorigin="anonymous" referrerpolicy="no-referrer" />

    {{-- FAVICON --}}
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('assets/favicon/aquarius-logo-navbar.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('assets/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('assets/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('assets/favicon/site.webmanifest') }}">
    
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-PH2GPHF');</script>
    <!-- End Google Tag Manager -->

    <!-- Google tag (gtag.js) -->
    <!--<script async src="https://www.googletagmanager.com/gtag/js?id=AW-845575285"></script>-->
    <!--<script>-->
    <!--  window.dataLayer = window.dataLayer || [];-->
    <!--  function gtag(){dataLayer.push(arguments);}-->
    <!--  gtag('js', new Date());-->
    
    <!--  gtag('config', 'AW-845575285');-->
    <!--</script>-->
