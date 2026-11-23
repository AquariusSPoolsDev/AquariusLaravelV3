@props([
    // [['name' => 'Page name in the page language', 'url' => '...'], ...] after "Homepage"
    'items',
])
@php
    // Built as an array and JSON-encoded, so "&" and quotes reach Google as text, not "&amp;"
    $crumbs = array_merge(
        [['name' => __('strings.navbar_homepage'), 'url' => route('homepage')]],
        $items,
    );

    $breadcrumbSchema = [
        '@context' => 'https://schema.org',
        '@type' => 'BreadcrumbList',
        'itemListElement' => collect($crumbs)->values()->map(fn (array $crumb, int $index): array => [
            '@type' => 'ListItem',
            'position' => $index + 1,
            'name' => html_entity_decode((string) $crumb['name'], ENT_QUOTES | ENT_HTML5, 'UTF-8'),
            'item' => $crumb['url'],
        ])->all(),
    ];
@endphp
<script type="application/ld+json">
{!! json_encode($breadcrumbSchema, JSON_UNESCAPED_UNICODE | JSON_UNESCAPED_SLASHES | JSON_HEX_TAG | JSON_PRETTY_PRINT) !!}
</script>
