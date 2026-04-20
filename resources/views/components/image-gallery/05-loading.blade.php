<div id="loading-indicator" style="display:none;" class="mb-4">
        <div class="relative">
            <x-reusables.alert color="info">
                <div class="flex gap-x-2 lg:gap-x-4 items-center">
                    <div class="shrink-0">
                        <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none"
                            stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"
                            class="">
                            <path d="m21.73 18-8-14a2 2 0 0 0-3.48 0l-8 14A2 2 0 0 0 4 21h16a2 2 0 0 0 1.73-3" />
                            <path d="M12 9v4" />
                            <path d="M12 17h.01" />
                        </svg>
                    </div>
                    <div class="grow">
                        <h3 class="text-lg lg:text-xl font-medium">
                            {{__('strings.showcase_search_loading')}}
                        </h3>
                        <div class="text-sm lg:text-base mt-2">
                            {{__('strings.showcase_search_loading_desc')}}
                        </div>
                    </div>
                </div>
            </x-reusables.alert>

            <div class="absolute top-0 inset-s-0 size-full bg-white/50"></div>

            <div class="absolute top-1/2 inset-s-1/2 transform -translate-x-1/2 -translate-y-1/2">
                <div class="animate-spin inline-block size-6 border-[3px] border-current border-t-transparent text-primary-600 rounded-full"
                    role="status" aria-label="loading">
                    <span class="sr-only">{{__('strings.showcase_search_loading')}}</span>
                </div>
            </div>
        </div>
    </div>