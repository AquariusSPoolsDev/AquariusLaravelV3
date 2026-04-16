@props(['headerTitle', 'headerSubtitle', 'imageFileLoc'])

<header class="relative bg-primary-900">
    <img loading="lazy" class="absolute top-0 left-0 w-full h-full object-cover" src="{{ asset('assets/images/'. $imageFileLoc) }}" alt="">

    <div class="absolute w-full h-full opacity-70"
        style=" background: radial-gradient(at 25% 90%, #78A3DA 0px, transparent 50%), radial-gradient(at 97% 94%, #1D4169 0px, transparent 50%), radial-gradient(at 11% 98%, #90e0ab 0px, transparent 50%), radial-gradient(at 80% 8%, #fef9c3 0px, transparent 50%), #3370B9;">
    </div>
    <div
        class="absolute w-full h-full opacity-70 bg-repeat"
        style="background-image: url('{{ asset('assets/images/header-dot-background.png') }}');">
    </div>

    <div class="relative z-10">
        <div class="container mx-auto px-4 pt-40 lg:pt-52 pb-24 lg:pb-32">
            <h1 class="aquarius-header-title max-lg:text-center font-semibold text-4xl lg:text-7xl mb-4 uppercase text-white drop-shadow-xl">
                {{ __('strings.' . $headerTitle) }}
            </h1>
            <p class="aquarius-header-subtitle max-lg:text-center text-base lg:text-lg text-gray-50 drop-shadow-xl">
                {{ __('strings.'. $headerSubtitle) }}
            </p>
        </div>
    </div>

</header>
