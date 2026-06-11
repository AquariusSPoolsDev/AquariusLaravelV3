{{-- A2: Homepage Trust / About Us Section --}}
{{-- Desktop: text left, image right. Mobile: stacked. --}}
{{-- Showroom images: swap placeholders with real photos post-photoshoot --}}

<section id="about">
    <div class="main-container">
        <div class="grid grid-cols-1 lg:grid-cols-2 gap-12 lg:gap-20 items-center">

            {{-- LEFT: Text content --}}
            <div class="max-w-xl">
                <x-reusables.pill-text>{{__('strings.trust_pill')}}</x-reusables.pill-text>
                <h2 class="text-3xl lg:text-5xl font-semibold text-primary-900 font-serif" data-animate data-delay="0">{{__('strings.trust_heading')}}</h2>
                <p class="text-neutral-600 mt-6 mb-8">{{__('strings.trust_body')}}</p>

                {{-- Stats bar --}}
                <div class="grid grid-cols-2 gap-6">

                    {{-- Stat 1 --}}
                    <div class="bg-white border border-neutral-200 rounded-xl p-4">
                        <span class="block text-3xl font-bold text-primary-700">30+</span>
                        <span class="text-sm text-neutral-600">{{__('strings.trust_stats_years')}}</span>
                    </div>

                    {{-- Stat 2 --}}
                    <div class="bg-white border border-neutral-200 rounded-xl p-4">
                        <span class="block text-3xl font-bold text-primary-700">1,000+</span>
                        <span class="text-sm text-neutral-600">{{__('strings.trust_stats_pools')}}</span>
                    </div>

                    {{-- Stat 3 --}}
                    <div class="col-span-2 bg-white border border-neutral-200 rounded-xl p-4">
                        <div class="flex items-center gap-4">
                            <div class="shrink-0">
                                <img src="{{ asset('assets/images/homepage/mspa-logo.png') }}" alt="Logo of Malaysian Swimming Pool Association" class="h-14 w-auto">
                            </div>
                            <div>
                                <span class="block text-xs text-neutral-500 uppercase tracking-wide">{{__('strings.trust_member_of')}}</span>
                                <span class="font-semibold text-neutral-800">Malaysian Swimming Pool Association</span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            {{-- RIGHT: Image grid (swap placeholders with real showroom photos post-photoshoot) --}}
            <div class="flex flex-col gap-4">
                {{-- Large: showroom exterior --}}
                <div class="overflow-hidden rounded-xl bg-neutral-100 aspect-video">
                    
                </div>
                {{-- Three smaller: pool displays --}}
                <div class="grid lg:grid-cols-3 gap-4">
                    <div class="overflow-hidden rounded-xl bg-neutral-100 aspect-4/3">
                        
                    </div>
                    <div class="overflow-hidden rounded-xl bg-neutral-100 aspect-4/3">
                        
                    </div>
                    <div class="overflow-hidden rounded-xl bg-neutral-100 aspect-4/3">
                        
                    </div>
                </div>
            </div>

        </div>
    </div>
</section>
