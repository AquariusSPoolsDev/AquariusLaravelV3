@props(['creation_step_title', 'step_number', 'is_last' => false])

<div class="flex gap-6 mb-2">
    {{-- Left: number + line --}}
    <div class="flex flex-col items-center gap-y-2">
        <div class="w-14 h-14 rounded-full bg-primary-50 flex items-center justify-center shrink-0">
            <span class="text-2xl font-bold text-primary-800">{{ $step_number }}</span>
        </div>
        @unless ($is_last)
            <div class="w-0.5 h-8 bg-neutral-200 my-1"></div>
        @endunless
    </div>

    {{-- Right: content --}}
    <div class="{{ $is_last ? 'pb-0' : 'pb-11' }} flex items-center">
        <h3 class="m-0 text-lg lg:text-xl font-semibold text-neutral-950">{{ $creation_step_title }}</h3>
    </div>
</div>
