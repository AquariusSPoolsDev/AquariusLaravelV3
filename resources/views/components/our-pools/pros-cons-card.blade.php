@props([
    // 'concrete', 'vinyl' or 'fibreglass'
    'pool',
    // 'advantage' or 'disadvantage'
    'type',
])

{{-- One pros or cons card for a pool page. Points come from {pool}_pool_{type}_{1-3}_title / _desc;
     a point whose title is empty is skipped, so filling in an empty slot in the lang files is enough to show it. --}}
<div class="pro-con-card">
    <h3 class="pro-con-card-title">{{ __("strings.{$pool}_pool_{$type}_title") }}</h3>
    <ul class="list-disc list-outside pl-5 space-y-2">
        @foreach (range(1, 3) as $point)
            @continue(blank(__("strings.{$pool}_pool_{$type}_{$point}_title")))
            <li>
                <strong class="text-neutral-950">{{ __("strings.{$pool}_pool_{$type}_{$point}_title") }}:</strong> {{ __("strings.{$pool}_pool_{$type}_{$point}_desc") }}
            </li>
        @endforeach
    </ul>
</div>
