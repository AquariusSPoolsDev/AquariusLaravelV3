<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@graph": [
        {
            "@@type": "Organization",
            "@@id": "{{ url('/') }}/#organization",
            "name": "Aquarius Swimming Pools Sdn Bhd",
            "alternateName": "Aquarius Pools",
            "url": "{{ url('/') }}",
            "logo": {
                "@@type": "ImageObject",
                "url": "{{ asset('assets/favicon/aquarius-logo-512.png') }}",
                "width": 512,
                "height": 512
            },
            "contactPoint": [
                {
                    "@@type": "ContactPoint",
                    "telephone": "+607-5953060",
                    "contactType": "customer service",
                    "areaServed": "MY",
                    "availableLanguage": ["English", "Malay"]
                },
                {
                    "@@type": "ContactPoint",
                    "telephone": "+6012-5105126",
                    "contactType": "sales",
                    "areaServed": "MY",
                    "availableLanguage": ["English", "Malay"]
                }
            ],
            "sameAs": [
                "https://facebook.com/AquariusSwimmingPools",
                "https://instagram.com/aquariusswimmingpools",
                "https://www.tiktok.com/@aquariuspools"
            ]
        },
        {
            "@@type": "WebSite",
            "@@id": "{{ url('/') }}/#website",
            "url": "{{ url('/') }}",
            "name": "Aquarius Swimming Pools",
            "description": "Swimming pool builder, contractor, and supplier in Johor Bahru, Malaysia.",
            "publisher": {
                "@@id": "{{ url('/') }}/#organization"
            },
            "potentialAction": {
                "@@type": "SearchAction",
                "target": {
                    "@@type": "EntryPoint",
                    "urlTemplate": "{{ url('/') }}/search?q={search_term_string}"
                },
                "query-input": "required name=search_term_string"
            },
            "inLanguage": ["en", "ms"]
        }
    ]
}
</script>
