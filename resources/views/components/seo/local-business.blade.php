@php
    // Rendered on every page, so the published-review rating is cached for an hour.
    // CustReview clears this cache whenever a review is saved or deleted.
    $reviewRating = \Illuminate\Support\Facades\Cache::remember(\App\Models\CustReview::RATING_CACHE_KEY, now()->addHour(), function (): array {
        $summary = \App\Models\CustReview::query()
            ->where('is_published', true)
            ->toBase()
            ->selectRaw('COUNT(*) as total, AVG(rating) as average')
            ->first();

        return ['count' => (int) $summary->total, 'average' => $summary->total > 0 ? round((float) $summary->average, 1) : null];
    });
    $reviewCount = $reviewRating['count'];
    $reviewAvg = $reviewRating['average'];
@endphp
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": ["GeneralContractor", "HomeAndConstructionBusiness"],
    "@@id": "{{ url('/') }}/#localbusiness",
    "name": "Aquarius Swimming Pools Sdn Bhd",
    "url": "{{ url('/') }}",
    "logo": "{{ asset('assets/favicon/aquarius-logo-512.png') }}",
    "image": "{{ asset('assets/images/pool_header/header-our-pools.jpg') }}",
    "description": "Swimming pool builder and contractor in Johor Bahru, Malaysia. Specialising in concrete, vinyl, and fibreglass pools for residential and commercial properties.",
    "telephone": ["+60125105126", "+6075953060"],
    "email": "mail@aquariuspools.com.my",
    "address": {
        "@@type": "PostalAddress",
        "streetAddress": "33, Jalan Selatan 3/4, Taman Impian Emas",
        "addressLocality": "Skudai",
        "addressRegion": "Johor",
        "postalCode": "81300",
        "addressCountry": "MY"
    },
    "geo": {
        "@@type": "GeoCoordinates",
        "latitude": 1.5334,
        "longitude": 103.6739
    },
    "openingHoursSpecification": [
        {
            "@@type": "OpeningHoursSpecification",
            "dayOfWeek": ["Monday", "Tuesday", "Wednesday", "Thursday", "Friday"],
            "opens": "08:00",
            "closes": "17:00"
        },
        {
            "@@type": "OpeningHoursSpecification",
            "dayOfWeek": "Saturday",
            "opens": "08:00",
            "closes": "12:00"
        }
    ],
    "sameAs": [
        "https://facebook.com/AquariusSwimmingPools",
        "https://instagram.com/aquariusswimmingpools",
        "https://www.tiktok.com/@aquariuspools",
        "https://wa.me/60125105126"
    ],
    "areaServed": [
        {
            "@@type": "City",
            "name": "Johor Bahru"
        },
        {
            "@@type": "AdministrativeArea",
            "name": "Johor"
        },
        {
            "@@type": "Country",
            "name": "Malaysia"
        },
        {
            "@@type": "City",
            "name": "Singapore"
        }
    ],
    "priceRange": "$$"@if($reviewAvg !== null),
    "aggregateRating": {
        "@@type": "AggregateRating",
        "ratingValue": "{{ $reviewAvg }}",
        "reviewCount": "{{ $reviewCount }}",
        "bestRating": "5",
        "worstRating": "1"
    }@endif
}
</script>
