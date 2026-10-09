<div class="flex flex-wrap items-center gap-4 rounded-xl bg-white p-6 shadow-sm ring-1 ring-gray-950/5 dark:bg-gray-900 dark:ring-white/10">
    <div class="flex size-16 shrink-0 items-center justify-center rounded-full bg-primary-600 text-xl font-semibold text-white" aria-hidden="true">
        {{ $initials }}
    </div>
    <div class="flex min-w-0 grow flex-col gap-0.5">
        <div class="flex flex-wrap items-center gap-2">
            <h2 class="text-xl font-semibold text-gray-950 dark:text-white">{{ $name }}</h2>
            @forelse ($roles as $role)
                <x-filament::badge>{{ $role }}</x-filament::badge>
            @empty
                <x-filament::badge color="gray">No role</x-filament::badge>
            @endforelse
        </div>
        <p class="truncate text-sm text-gray-600 dark:text-gray-300">{{ $email }}</p>
        @if ($memberSince)
            <p class="text-sm text-gray-500 dark:text-gray-400">Member since {{ $memberSince }}</p>
        @endif
    </div>
</div>
