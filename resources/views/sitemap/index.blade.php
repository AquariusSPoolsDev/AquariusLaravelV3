<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">

@php
    $pages = [
        ['route' => 'homepage',              'args' => [],       'freq' => 'weekly',  'priority' => '1.0'],
        ['route' => 'our-pools-main',        'args' => [],       'freq' => 'monthly', 'priority' => '0.8'],
        ['route' => 'concrete-pools-page',   'args' => [],       'freq' => 'monthly', 'priority' => '0.8'],
        ['route' => 'vinyl-pools-page',      'args' => [],       'freq' => 'monthly', 'priority' => '0.8'],
        ['route' => 'fibreglass-pools-page', 'args' => [],       'freq' => 'monthly', 'priority' => '0.8'],
        ['route' => 'pool-services-page',    'args' => [],       'freq' => 'monthly', 'priority' => '0.7'],
        ['route' => 'pool-items-page',       'args' => [],       'freq' => 'monthly', 'priority' => '0.7'],
        ['route' => 'pool-showcase-gallery', 'args' => [],       'freq' => 'weekly',  'priority' => '0.6'],
        ['route' => 'projects-page',         'args' => [],       'freq' => 'weekly',  'priority' => '0.7'],
        ['route' => 'customer-reviews-page', 'args' => [],       'freq' => 'weekly',  'priority' => '0.5'],
        ['route' => 'promo-page',            'args' => [],       'freq' => 'weekly',  'priority' => '0.6'],
        ['route' => 'faq-page',              'args' => [],       'freq' => 'monthly', 'priority' => '0.6'],
        ['route' => 'contact-page',          'args' => [],       'freq' => 'monthly', 'priority' => '0.6'],
        ['route' => 'about-page',            'args' => [],       'freq' => 'monthly', 'priority' => '0.5'],
    ];
@endphp

@foreach($pages as $page)
@php
    $enUrl = route($page['route'], array_merge(['locale' => 'en'], $page['args']));
    $msUrl = route($page['route'], array_merge(['locale' => 'ms'], $page['args']));
@endphp
    {{-- English --}}
    <url>
        <loc>{{ $enUrl }}</loc>
        <changefreq>{{ $page['freq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
        <xhtml:link rel="alternate" hreflang="en" href="{{ $enUrl }}"/>
        <xhtml:link rel="alternate" hreflang="ms" href="{{ $msUrl }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $enUrl }}"/>
    </url>
    {{-- Malay --}}
    <url>
        <loc>{{ $msUrl }}</loc>
        <changefreq>{{ $page['freq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
        <xhtml:link rel="alternate" hreflang="en" href="{{ $enUrl }}"/>
        <xhtml:link rel="alternate" hreflang="ms" href="{{ $msUrl }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $enUrl }}"/>
    </url>
@endforeach

    {{-- Project detail pages --}}
@foreach($projects as $project)
@php
    $enUrl = route('project-detail-page', ['locale' => 'en', 'slug' => $project->slug]);
    $msUrl = route('project-detail-page', ['locale' => 'ms', 'slug' => $project->slug]);
@endphp
    <url>
        <loc>{{ $enUrl }}</loc>
        <lastmod>{{ $project->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
        <xhtml:link rel="alternate" hreflang="en" href="{{ $enUrl }}"/>
        <xhtml:link rel="alternate" hreflang="ms" href="{{ $msUrl }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $enUrl }}"/>
    </url>
    <url>
        <loc>{{ $msUrl }}</loc>
        <lastmod>{{ $project->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
        <xhtml:link rel="alternate" hreflang="en" href="{{ $enUrl }}"/>
        <xhtml:link rel="alternate" hreflang="ms" href="{{ $msUrl }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $enUrl }}"/>
    </url>
@endforeach

</urlset>
