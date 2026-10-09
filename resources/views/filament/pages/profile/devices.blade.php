<ul class="flex flex-col divide-y divide-gray-100 dark:divide-white/10">
    @forelse ($devices as $device)
        <li class="flex items-center gap-3 py-3 first:pt-0 last:pb-0">
            <x-filament::icon
                :icon="in_array($device['platform'], ['iOS', 'Android'], true) ? 'heroicon-o-device-phone-mobile' : 'heroicon-o-computer-desktop'"
                class="size-6 shrink-0 text-gray-400 dark:text-gray-500"
            />
            <div class="flex min-w-0 grow flex-col">
                <span class="text-sm font-medium text-gray-950 dark:text-white">{{ $device['browser'] }} · {{ $device['platform'] }}</span>
                <span class="text-xs text-gray-500 dark:text-gray-400">{{ $device['ipAddress'] ?? 'Unknown IP' }}</span>
            </div>
            @if ($device['isCurrentDevice'])
                <x-filament::badge color="success">This device</x-filament::badge>
            @else
                <span class="shrink-0 text-xs text-gray-500 dark:text-gray-400">{{ $device['lastActive'] }}</span>
            @endif
        </li>
    @empty
        <li class="text-sm text-gray-500 dark:text-gray-400">No active sessions found.</li>
    @endforelse
</ul>
