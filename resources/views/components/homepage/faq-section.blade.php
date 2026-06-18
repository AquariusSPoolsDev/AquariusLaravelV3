<section id="faq" class="faq-section">
    <div class="main-container">
        <div class="max-w-4xl mx-auto">
            <div class="text-center mb-8">
                <x-reusables.pill-text class="text-center block" data-animate data-delay="0">{{ __('strings.homepage_faq_pill') }}</x-reusables.pill-text>
                <h2 class="aquarius-homepage-heading" data-animate data-delay="100">{{ __('strings.homepage_faq_heading') }}</h2>
            </div>

            <div class="mt-12 flex flex-col gap-2.5" x-data="{ active: null }" data-animate data-delay="200">

                {{-- Q1: Materials --}}
                <div class="aquarius-accordion" :class="active === 0 && 'accordion-active'">
                    <button class="aquarius-accordion-toggle" :aria-expanded="active === 0" @click="active = active === 0 ? null : 0">
                        {{ __('strings.faq_different_material_avail') }}
                        <span class="toggle-icon" aria-hidden="true">
                            <svg width="11" height="11" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path></svg>
                        </span>
                    </button>
                    <div class="aquarius-accordion-content" x-show="active === 0" x-cloak x-transition role="region">
                        <div class="accordion-inner">
                            <p>{{ __('strings.faq_different_material_avail_answer_1') }} <a href="{{ route('our-pools-main') }}" class="text-primary-600 underline underline-offset-4 hover:text-primary-700 hover:no-underline">{{ __('strings.faq_different_material_avail_link_text') }}</a> {{ __('strings.faq_different_material_avail_answer_2') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Q2: Pool sizes --}}
                <div class="aquarius-accordion" :class="active === 1 && 'accordion-active'">
                    <button class="aquarius-accordion-toggle" :aria-expanded="active === 1" @click="active = active === 1 ? null : 1">
                        {{ __('strings.faq_popular_pool_size') }}
                        <span class="toggle-icon" aria-hidden="true">
                            <svg width="11" height="11" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path></svg>
                        </span>
                    </button>
                    <div class="aquarius-accordion-content" x-show="active === 1" x-cloak x-transition role="region">
                        <div class="accordion-inner">
                            <p class="mb-3">{{ __('strings.faq_popular_pool_size_answer_1') }}</p>
                            <p>{{ __('strings.faq_popular_pool_size_answer_3') }}</p>
                        </div>
                    </div>
                </div>

                {{-- Q3: Maintenance --}}
                <div class="aquarius-accordion" :class="active === 2 && 'accordion-active'">
                    <button class="aquarius-accordion-toggle" :aria-expanded="active === 2" @click="active = active === 2 ? null : 2">
                        {{ __('strings.faq_kind_maintenance') }}
                        <span class="toggle-icon" aria-hidden="true">
                            <svg width="11" height="11" viewBox="0 0 256 256" fill="currentColor"><path d="M224,128a8,8,0,0,1-8,8H136v80a8,8,0,0,1-16,0V136H40a8,8,0,0,1,0-16h80V40a8,8,0,0,1,16,0v80h80A8,8,0,0,1,224,128Z"></path></svg>
                        </span>
                    </button>
                    <div class="aquarius-accordion-content" x-show="active === 2" x-cloak x-transition role="region">
                        <div class="accordion-inner">
                            <p class="mb-3">{{ __('strings.faq_kind_maintenance_answer_1') }}</p>
                            <ul class="mb-3 ps-5 space-y-2 list-disc list-inside">
                                <li><strong class="text-neutral-900">{{ __('strings.faq_kind_maintenance_answer_steps_1') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_1_detail') }}</li>
                                <li><strong class="text-neutral-900">{{ __('strings.faq_kind_maintenance_answer_steps_2') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_2_detail') }}</li>
                                <li><strong class="text-neutral-900">{{ __('strings.faq_kind_maintenance_answer_steps_3') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_3_detail') }}</li>
                                <li><strong class="text-neutral-900">{{ __('strings.faq_kind_maintenance_answer_steps_4') }}</strong> {{ __('strings.faq_kind_maintenance_answer_steps_4_detail') }}</li>
                            </ul>
                        </div>
                    </div>
                </div>

            </div>

            <div class="mt-8 text-center" data-animate data-delay="300">
                <a href="{{ route('faq-page') }}" class="faq-view-all-btn">
                    {{ __('strings.homepage_faq_view_all') }}
                    <svg class="size-5 transition-transform group-hover:translate-x-1" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
                </a>
            </div>
        </div>
    </div>
</section>
