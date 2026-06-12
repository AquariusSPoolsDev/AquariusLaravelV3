@props([
    'title'  => __('strings.projects_contact_cta_title'),
    'body'   => __('strings.projects_contact_cta_body'),
    'label'  => __('strings.projects_get_quote'),
    'href'   => null,
])

<section class="relative overflow-hidden bg-primary-50">
    <div class="cta-aurora-bg"></div>
    <div class="main-container relative z-10">
        <div class="flex flex-col items-center gap-6 text-center sm:flex-row sm:justify-between sm:text-left" data-animate data-delay="0">
            <div>
                <h2 class="text-2xl lg:text-3xl font-semibold text-primary-900">{{ $title }}</h2>
                <p class="mt-1.5 text-neutral-600">{{ $body }}</p>
            </div>
            <a href="{{ $href ?? route('contact-page') }}" class="cta-strip-btn shrink-0">
                {{ $label }}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M5 12h14"/><path d="m12 5 7 7-7 7"/></svg>
            </a>
        </div>
    </div>
</section>
