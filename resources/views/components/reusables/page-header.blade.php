@props(['headerTitle', 'headerSubtitle', 'imageFileLoc'])

<header class="aquarius-header">
    <img loading="lazy" class="aquarius-header-image" src="{{ asset('assets/images/'. $imageFileLoc) }}" alt="">

    <div class="aquarius-header-overlay"
        style=" background: radial-gradient(at 25% 90%, #78A3DA 0px, transparent 50%), radial-gradient(at 97% 94%, #1D4169 0px, transparent 50%), radial-gradient(at 11% 98%, #90e0ab 0px, transparent 50%), radial-gradient(at 80% 8%, #fef9c3 0px, transparent 50%), #3370B9;">
    </div>
    <div
        class="aquarius-header-dot-background"
        style="background-image: url('{{ asset('assets/images/header-dot-background.png') }}');">
    </div>

    <div class="aquarius-header-content">
        <div class="aquarius-header-container">
            <h1 class="aquarius-header-title">
                {{ __('strings.' . $headerTitle) }}
            </h1>
            <p class="aquarius-header-subtitle">
                {{ __('strings.'. $headerSubtitle) }}
            </p>
        </div>
    </div>

</header>
