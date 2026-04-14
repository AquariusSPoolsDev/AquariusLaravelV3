<section id="our-pools" class="main-container" x-data="{ activeTab: 'concrete' }">
    <h2 class="aquarius-homepage-heading">{{__('strings.pools_heading')}}</h2>
    <div class="aquarius-our-pools-tab-main">
        <div class="lg:w-[32%]">
            <nav class="aquarius-our-pools-tablist" aria-label="Our Pools Tabs" role="tablist" aria-orientation="horizontal">
                <button type="button" class="aquarius-our-pools-tab" :class="activeTab === 'concrete' && 'tab-active'"
                    :aria-selected="activeTab === 'concrete'" @click="activeTab = 'concrete'" role="tab">
                    {{__('strings.pools_concrete')}}
                </button>

                <button type="button" class="aquarius-our-pools-tab" :class="activeTab === 'vinyl' && 'tab-active'"
                    :aria-selected="activeTab === 'vinyl'" @click="activeTab = 'vinyl'" role="tab">
                    {{__('strings.pools_vinyl')}}
                </button>

                <button type="button" class="aquarius-our-pools-tab" :class="activeTab === 'fibreglass' && 'tab-active'"
                    :aria-selected="activeTab === 'fibreglass'" @click="activeTab = 'fibreglass'" role="tab">
                    {{__('strings.pools_fibreglass')}}
                </button>
            </nav>
        </div>

        <div class="w-full lg:w-[62%]">
            {{-- CONCRETE POOL CARD --}}
            <div x-show="activeTab === 'concrete'" class="aquarius-our-pools-tab-content" role="tabpanel">
                <p class="aquarius-our-pools-tab-desc">
                    {!!__('strings.pools_concrete_desc')!!}
                </p>
                <div class="aquarius-our-pools-image-grid">
                    <div class="aquarius-our-pools-image-content">
                        <img loading="lazy" src="{{ asset('assets/images/concrete-pools-homepage-1.jpg') }}" title="Concrete Pools" alt="Concrete Pool Image 1">
                    </div>
                    <div class="aquarius-our-pools-image-content hidden lg:block">
                        <img loading="lazy" src="{{ asset('assets/images/concrete-pools-homepage-2.jpg') }}" title="Concrete Pools" alt="Concrete Pool Image 2">
                    </div>
                    <div class="aquarius-our-pools-image-content hidden lg:block">
                        <img loading="lazy" src="{{ asset('assets/images/concrete-pools-homepage-3.jpg') }}" title="Concrete Pools" alt="Concrete Pool Image 3">
                    </div>
                </div>
                <div class="aquarius-our-pools-link group">
                    <a href="{{ route('concrete-pools-page') }}" title="{{__('strings.pools_concrete_link_title')}}" class="link-text">
                        {{__('strings.pools_concrete_link')}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                </div>
            </div>
            {{-- CONCRETE POOL CARD --}}

            {{-- VINYL POOL CARD --}}
            <div x-show="activeTab === 'vinyl'" x-cloak class="aquarius-our-pools-tab-content" role="tabpanel">
                <p class="aquarius-our-pools-tab-desc">
                    {!!__('strings.pools_vinyl_desc')!!}
                </p>
                <div class="aquarius-our-pools-image-grid">
                    <div class="aquarius-our-pools-image-content">
                        <img loading="lazy" src="{{ asset('assets/images/vinyl-pool-homepage-1.jpg') }}" title="Vinyl Pools" alt="Vinyl Pool Image 1">
                    </div>
                    <div class="aquarius-our-pools-image-content hidden lg:block">
                        <img loading="lazy" src="{{ asset('assets/images/vinyl-pool-homepage-2.jpg') }}" title="Vinyl Pools" alt="Vinyl Pool Image 2">
                    </div>
                    <div class="aquarius-our-pools-image-content hidden lg:block">
                        <img loading="lazy" src="{{ asset('assets/images/vinyl-pool-homepage-3.jpg') }}" title="Vinyl Pools" alt="Vinyl Pool Image 3">
                    </div>
                </div>
                <div class="aquarius-our-pools-link group">
                    <a href="{{ route('vinyl-pools-page') }}" title="{{__('strings.pools_vinyl_link_title')}}" class="link-text">
                        {{__('strings.pools_vinyl_link')}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                </div>
            </div>
            {{-- VINYL POOL CARD --}}

            {{-- FIBREGLASS POOL CARD --}}
            <div x-show="activeTab === 'fibreglass'" x-cloak class="aquarius-our-pools-tab-content" role="tabpanel">
                <p class="aquarius-our-pools-tab-desc">
                    {!! trans('strings.pools_fibreglass_desc')!!}
                </p>
                <div class="aquarius-our-pools-image-grid">
                    <div class="aquarius-our-pools-image-content">
                        <img loading="lazy" src="{{ asset('assets/images/fibreglass-pools-homepage-1.jpg') }}" title="Fibreglass Pools" alt="Fibreglass Pool Image 1">
                    </div>
                    <div class="aquarius-our-pools-image-content hidden lg:block">
                        <img loading="lazy" src="{{ asset('assets/images/fibreglass-pools-homepage-2.jpg') }}" title="Fibreglass Pools" alt="Fibreglass Pool Image 2">
                    </div>
                    <div class="aquarius-our-pools-image-content hidden lg:block">
                        <img loading="lazy" src="" title="Fibreglass Pools" alt="Fibreglass Pool Image 3">
                    </div>
                </div>
                <div class="aquarius-our-pools-link group">
                    <a href="{{ route('fibreglass-pools-page') }}" title="{{__('strings.pools_fibreglass_link_title')}}" class="link-text">
                        {{__('strings.pools_fibreglass_link')}}
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24"
                            fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                            stroke-linejoin="round">
                            <path d="m9 18 6-6-6-6" />
                        </svg>
                    </a>
                </div>
            </div>
            {{-- FIBREGLASS POOL CARD --}}

        </div>
    </div>
</section>