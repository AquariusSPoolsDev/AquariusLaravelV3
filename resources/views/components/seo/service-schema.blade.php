@props(['serviceName', 'serviceDescription', 'serviceUrl'])
@php
    // Pages pass text through {{ }} already; decode it once, then JSON-encode so Google gets plain text
    $plain = fn (string $text): string => html_entity_decode($text, ENT_QUOTES | ENT_HTML5, 'UTF-8');

    $serviceSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'Service',
        'name' => $plain($serviceName),
        'description' => $plain($serviceDescription),
        'url' => $serviceUrl,
        'inLanguage' => str_replace('_', '-', app()->getLocale()),
        'provider' => [
            '@type' => 'LocalBusiness',
            '@id' => url('/').'/#localbusiness',
            'name' => 'Aquarius Swimming Pools Sdn Bhd',
        ],
        'areaServed' => [
            '@type' => 'State',
            'name' => 'Johor',
        ],
        'serviceType' => 'Swimming Pool Construction',
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($serviceSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_PRETTY_PRINT) !!}
</script>
