<ul class="grid grid-cols-1 gap-2 sm:grid-cols-2">
    @foreach ($resources as $resource)
        <li @class([
            'flex items-center gap-2 text-sm',
            'text-gray-950 dark:text-white' => $resource['canAccess'],
            'text-gray-400 dark:text-gray-500' => ! $resource['canAccess'],
        ])>
            @if ($resource['canAccess'])
                <x-filament::icon icon="heroicon-m-check-circle" class="size-5 text-success-600 dark:text-success-400" />
                <span>{{ $resource['label'] }}</span>
            @else
                <x-filament::icon icon="heroicon-m-x-circle" class="size-5 text-gray-400 dark:text-gray-500" />
                <span><span class="sr-only">No access: </span>{{ $resource['label'] }}</span>
            @endif
        </li>
    @endforeach
</ul>
