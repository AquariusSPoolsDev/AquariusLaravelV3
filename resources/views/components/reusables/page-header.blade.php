@props(['headerTitle', 'headerSubtitle', 'imageFileLoc'])

<header class="aquarius-header">
    <picture>
        <source srcset="{{ asset('assets/images/pool_header/webp/' . pathinfo($imageFileLoc, PATHINFO_FILENAME) . '.webp') }}" type="image/webp">
        {{-- Top of every inner page and its largest image (LCP), so it loads first, never lazily --}}
        <img fetchpriority="high" decoding="async" class="aquarius-header-image" src="{{ asset('assets/images/pool_header/'. $imageFileLoc) }}" alt="">
    </picture>

    <div class="aquarius-header-overlay"></div>

    <div class="aquarius-header-content">
        <div class="aquarius-header-container">
            <h1 class="aquarius-header-title">
                {{ Lang::has('strings.' . $headerTitle) ? __('strings.' . $headerTitle) : $headerTitle }}
            </h1>
            <p class="aquarius-header-subtitle">
                {{ Lang::has('strings.' . $headerSubtitle) ? __('strings.' . $headerSubtitle) : $headerSubtitle }}
            </p>
        </div>
    </div>

</header>
