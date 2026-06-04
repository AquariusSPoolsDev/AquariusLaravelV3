<?php echo '<?xml version="1.0" encoding="UTF-8"?>'; ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">

    {{-- Homepage --}}
    <url>
        <loc>{{ url('/') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>1.0</priority>
    </url>

    {{-- Pool Types --}}
    <url>
        <loc>{{ route('our-pools-main') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('concrete-pools-page') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('vinyl-pools-page') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>
    <url>
        <loc>{{ route('fibreglass-pools-page') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.8</priority>
    </url>

    {{-- Services & Products --}}
    <url>
        <loc>{{ route('pool-services-page') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>
    <url>
        <loc>{{ route('pool-items-page') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.7</priority>
    </url>

    {{-- Gallery & Showcase --}}
    <url>
        <loc>{{ route('pool-showcase-gallery') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>

    {{-- Projects --}}
    <url>
        <loc>{{ route('projects-page') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.7</priority>
    </url>
    @foreach($projects as $project)
    <url>
        <loc>{{ route('project-detail-page', $project->slug) }}</loc>
        <lastmod>{{ $project->updated_at->toAtomString() }}</lastmod>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    @endforeach

    {{-- Other public pages --}}
    <url>
        <loc>{{ route('promo-page') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ route('customer-reviews-page') }}</loc>
        <changefreq>weekly</changefreq>
        <priority>0.5</priority>
    </url>
    <url>
        <loc>{{ route('faq-page') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ route('contact-page') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.6</priority>
    </url>
    <url>
        <loc>{{ route('about-page') }}</loc>
        <changefreq>monthly</changefreq>
        <priority>0.5</priority>
    </url>

</urlset>
