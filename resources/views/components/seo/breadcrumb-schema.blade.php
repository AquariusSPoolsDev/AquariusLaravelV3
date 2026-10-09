@props(['items'])
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "BreadcrumbList",
    "itemListElement": [
        {
            "@@type": "ListItem",
            "position": 1,
            "name": "Home",
            "item": "{{ url('/' . (app()->getLocale() === 'ms_MY' ? 'ms' : 'en')) }}"
        }@foreach($items as $index => $crumb),
        {
            "@@type": "ListItem",
            "position": {{ $index + 2 }},
            "name": "{{ $crumb['name'] }}",
            "item": "{{ $crumb['url'] }}"
        }@endforeach
    ]
}
</script>
