<section class="relative overflow-hidden bg-primary-50">
    <div class="cta-aurora-bg"></div>
    <div class="main-container relative z-10">
        <div class="flex flex-col items-center gap-6 text-center sm:flex-row sm:justify-between sm:text-left" data-animate data-delay="0">
            <div>
                <h2 class="text-2xl lg:text-3xl font-semibold text-primary-900">{{ __('strings.homepage_cta_strip_heading') }}</h2>
                <p class="mt-1.5 text-neutral-600">{{ __('strings.homepage_cta_strip_body') }}</p>
            </div>
            <a href="{{ route('contact-page') }}" class="cta-strip-btn shrink-0">
                {{ __('strings.homepage_cta_strip_btn') }}
                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
            </a>
        </div>
    </div>
</section>
