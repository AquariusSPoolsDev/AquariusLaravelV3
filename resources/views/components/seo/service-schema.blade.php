@props(['serviceName', 'serviceDescription', 'serviceUrl'])
<script type="application/ld+json">
{
    "@@context": "https://schema.org",
    "@@type": "Service",
    "name": "{{ $serviceName }}",
    "description": "{{ $serviceDescription }}",
    "url": "{{ $serviceUrl }}",
    "provider": {
        "@@type": "LocalBusiness",
        "@@id": "{{ url('/') }}/#localbusiness",
        "name": "Aquarius Swimming Pools Sdn Bhd"
    },
    "areaServed": {
        "@@type": "State",
        "name": "Johor"
    },
    "serviceType": "Swimming Pool Construction"
}
</script>
