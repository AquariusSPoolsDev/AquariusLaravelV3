<?php

namespace App\Http\Controllers;

use App\Enums\SitePage;
use App\Models\CustReview;
use App\Models\ImageGallery;
use App\Models\Project;
use App\Models\Promotion;
use Illuminate\Http\Response;
use Illuminate\Support\Carbon;

class SitemapController extends Controller
{
    /**
     * Indexable pages: route name => [page view, changefreq, priority].
     *
     * @var array<string, array{0: string, 1: string, 2: string}>
     */
    private const PAGES = [
        'homepage' => ['pages.01-homepage', 'weekly', '1.0'],
        'our-pools-main' => ['pages.02-pool-type-main', 'monthly', '0.8'],
        'concrete-pools-page' => ['pages.pool-type', 'monthly', '0.8'],
        'vinyl-pools-page' => ['pages.pool-type', 'monthly', '0.8'],
        'fibreglass-pools-page' => ['pages.pool-type', 'monthly', '0.8'],
        'pool-services-page' => ['pages.06-pool-services', 'monthly', '0.7'],
        'pool-items-page' => ['pages.07-pool-essentials', 'monthly', '0.7'],
        'pool-showcase-gallery' => ['pages.08-pool-showcase-gallery', 'weekly', '0.6'],
        'projects-page' => ['pages.17-projects', 'weekly', '0.7'],
        'customer-reviews-page' => ['pages.09-cust-review', 'weekly', '0.5'],
        'promo-page' => ['pages.12-promotions', 'weekly', '0.6'],
        'faq-page' => ['pages.11-faq', 'monthly', '0.6'],
        'contact-page' => ['pages.10-contact-us', 'monthly', '0.6'],
    ];

    public function index(): Response
    {
        $projects = SitePage::Projects->isVisible()
            ? Project::where('is_published', true)
                ->select('slug', 'updated_at')
                ->orderBy('sort_order')
                ->get()
            : collect();

        $content = view('sitemap.index', [
            'pages' => $this->visiblePages($projects->max('updated_at')),
            'projects' => $projects,
        ])->render();

        return response($content, 200)->header('Content-Type', 'application/xml');
    }

    /**
     * Pages not switched off on the admin Page Visibility screen, each with a lastmod date:
     * the newest of its page template, the translation files, and (for listing pages) its records.
     *
     * @return list<array{route: string, freq: string, priority: string, lastmod: Carbon}>
     */
    private function visiblePages(?Carbon $latestProjectUpdate): array
    {
        $translationsUpdatedAt = max(
            filemtime(lang_path('en_MY/strings.php')),
            filemtime(lang_path('ms_MY/strings.php')),
        );

        $recordsUpdatedAt = [
            'pool-showcase-gallery' => ImageGallery::published()->max('updated_at'),
            'customer-reviews-page' => CustReview::query()->published()->max('updated_at'),
            'promo-page' => Promotion::max('updated_at'),
            'projects-page' => $latestProjectUpdate,
        ];

        $pages = [];

        foreach (self::PAGES as $route => [$view, $freq, $priority]) {
            if (! (SitePage::forRoute($route)?->isVisible() ?? true)) {
                continue;
            }

            $viewPath = resource_path('views/'.str_replace('.', '/', $view).'.blade.php');
            $timestamps = [$translationsUpdatedAt, filemtime($viewPath)];

            if (isset($recordsUpdatedAt[$route])) {
                $timestamps[] = Carbon::parse($recordsUpdatedAt[$route])->getTimestamp();
            }

            $pages[] = [
                'route' => $route,
                'freq' => $freq,
                'priority' => $priority,
                'lastmod' => Carbon::createFromTimestamp(max($timestamps)),
            ];
        }

        return $pages;
    }
}
