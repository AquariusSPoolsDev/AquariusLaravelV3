@props(['pool_item_image','pool_item_title', 'pool_item_body'])

{{-- CARD --}}
<div
    x-data="{
        open: false,
        openModal() { this.open = true; document.body.classList.add('overflow-hidden'); },
        closeModal() { this.open = false; document.body.classList.remove('overflow-hidden'); }
    }"
    @keydown.escape.window="closeModal()"
    @click="{{ isset($modal) ? 'openModal()' : '' }}"
    class="aquarius-pool-item-card {{ isset($modal) ? 'is-clickable' : '' }}"
>
    <div class="aquarius-pool-item-card-image">
        <img src="{{ $pool_item_image }}" alt="{{ $pool_item_title }}">
    </div>
    <div class="aquarius-pool-item-card-body">
        <h3>{{ $pool_item_title }}</h3>
        <p class="{{ isset($modal) ? 'mb-4' : 'mb-0' }}">{{ $pool_item_body }}</p>
        @isset($modal)
        <span class="aquarius-pool-item-card-cta">
            {{ __('strings.modal_learn_more') }}
            <svg xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2.5"><path stroke-linecap="round" stroke-linejoin="round" d="M13.5 4.5L21 12m0 0l-7.5 7.5M21 12H3"/></svg>
        </span>
        @endisset
    </div>

    @isset($modal)
    <template x-teleport="body">
        {{-- BACKDROP --}}
        <div
            x-show="open"
            x-cloak
            x-transition:enter="transition-opacity ease-out duration-300"
            x-transition:enter-start="opacity-0"
            x-transition:enter-end="opacity-100"
            x-transition:leave="transition-opacity ease-in duration-200"
            x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0"
            @click="closeModal()"
            class="pool-item-modal-backdrop"
        >
            {{-- MODAL PANEL --}}
            <div
                x-show="open"
                x-transition:enter="transition ease-out duration-300"
                x-transition:enter-start="opacity-0 scale-95 translate-y-4"
                x-transition:enter-end="opacity-100 scale-100 translate-y-0"
                x-transition:leave="transition ease-in duration-200"
                x-transition:leave-start="opacity-100 scale-100 translate-y-0"
                x-transition:leave-end="opacity-0 scale-95 translate-y-4"
                @click.stop
                class="pool-item-modal-panel"
            >
                <div class="pool-item-modal-layout">
                    <div class="pool-item-modal-image">
                        <img src="{{ $pool_item_image }}" alt="{{ $pool_item_title }}">
                    </div>
                    <div class="pool-item-modal-content">
                        <div class="pool-item-modal-header">
                            <h3>{{ $pool_item_title }}</h3>
                            <button @click="closeModal()" aria-label="Close">
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" fill="none" viewBox="0 0 24 24" stroke="currentColor" stroke-width="2"><path stroke-linecap="round" stroke-linejoin="round" d="M6 18L18 6M6 6l12 12"/></svg>
                            </button>
                        </div>
                        <div class="pool-item-modal-body">
                            {{ $modal }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </template>
    @endisset
</div>
{{-- CARD --}}
