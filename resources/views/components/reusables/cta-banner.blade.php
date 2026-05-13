@props([
    'title'  => __('strings.projects_contact_cta_title'),
    'body'   => __('strings.projects_contact_cta_body'),
    'label'  => __('strings.projects_get_quote'),
    'href'   => null,
])

<section class="aquarius-cta-banner">
    <div class="aquarius-cta-banner-aurora" aria-hidden="true"></div>
    <div class="container mx-auto px-4 md:px-6 lg:px-8 relative z-10 text-center py-16 lg:py-20">
        <h2 class="text-2xl lg:text-4xl font-bold text-white mb-4">{{ $title }}</h2>
        <p class="text-neutral-300 text-base lg:text-lg mb-8">{{ $body }}</p>
        <a href="{{ $href ?? route('contact-page') }}"
            class="group inline-flex items-center gap-2 bg-white text-primary-900 font-semibold px-7 py-3.5 rounded-xl hover:bg-primary-50 active:bg-primary-100 active:scale-95 transition-all duration-200 shadow-lg">
            {{ $label }}
            <svg class="w-5 h-5 transition-transform duration-200 group-hover:translate-x-1 group-active:translate-x-1" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2">
                <path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/>
            </svg>
        </a>
    </div>
</section>
