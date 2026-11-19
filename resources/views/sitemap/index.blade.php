<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9"
        xmlns:xhtml="http://www.w3.org/1999/xhtml">


@foreach($pages as $page)
@php
    $enUrl = route($page['route'], ['locale' => 'en']);
    $msUrl = route($page['route'], ['locale' => 'ms']);
@endphp
    {{-- English --}}
    <url>
        <loc>{{ $enUrl }}</loc>
        <lastmod>{{ $page['lastmod']->toAtomString() }}</lastmod>
        <changefreq>{{ $page['freq'] }}</changefreq>
        <priority>{{ $page['priority'] }}</priority>
        <xhtml:link rel="alternate" hreflang="en" href="{{ $enUrl }}"/>
        <xhtml:link rel="alternate" hreflang="ms" href="{{ $msUrl }}"/>
        <xhtml:link rel="alternate" hreflang="x-default" href="{{ $enUrl }}"/>
    </url>
    {{-- Malay --}}
    <url>
        <loc>{{ $msUrl }}</loc>
        <lastmod>{{ $page['lastmod']->toAtomString() }}</lastmod>
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
