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
            <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 256 256" fill="currentColor"><path d="M221.66,133.66l-72,72a8,8,0,0,1-11.32-11.32L196.69,136H40a8,8,0,0,1,0-16H196.69L138.34,61.66a8,8,0,0,1,11.32-11.32l72,72A8,8,0,0,1,221.66,133.66Z"></path></svg>
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
                                <svg xmlns="http://www.w3.org/2000/svg" class="size-8" viewBox="0 0 256 256" fill="currentColor"><path d="M205.66,194.34a8,8,0,0,1-11.32,11.32L128,139.31,61.66,205.66a8,8,0,0,1-11.32-11.32L116.69,128,50.34,61.66A8,8,0,0,1,61.66,50.34L128,116.69l66.34-66.35a8,8,0,0,1,11.32,11.32L139.31,128Z"></path></svg>
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
