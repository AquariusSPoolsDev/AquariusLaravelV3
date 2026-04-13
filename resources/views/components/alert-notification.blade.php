<div {{ $attributes->merge(['class' => 'p-4 mb-4 rounded-lg border']) }} role="alert">
    @isset($alert)
        {{ $alert }}
    @endisset
</div>