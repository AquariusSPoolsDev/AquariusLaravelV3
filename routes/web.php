<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\ProjectController;
use App\Http\Controllers\PromotionController;
use App\Http\Controllers\ReviewController;
use App\Http\Controllers\SitemapController;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/**
 * Permanently redirect an unprefixed URL to its /en equivalent, keeping the query string
 * (pagination, search filters, UTM tags).
 */
$redirectToEnglish = function (Request $request): RedirectResponse {
    $query = $request->getQueryString();

    return redirect('/en'.rtrim($request->getPathInfo(), '/').($query ? '?'.$query : ''), 301);
};

// ─── Utility routes (no locale prefix) ───────────────────────────────────────

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap-xml');

Route::post('/send-email', [ContactFormController::class, 'sendEmail'])
    ->middleware('throttle:1,60')
    ->name('send-email-page');

Route::get('/thank-you', function () {
    return view('pages.15-thankYouSubmitPage');
})->name('thank-you');

Route::post('/dismiss-promotion', function () {
    session(['promotion_dismissed' => true]);

    return response()->json(['success' => true]);
})->name('dismiss-promotion');

// ─── Root redirect → /en ──────────────────────────────────────────────────────

Route::get('/', $redirectToEnglish);

// ─── Locale-prefixed public routes ───────────────────────────────────────────

Route::prefix('{locale}')
    ->where(['locale' => 'en|ms'])
    ->group(function () {

        // Homepage
        Route::get('/', function () {
            return view('pages.01-homepage');
        })->name('homepage');

        // About Us
        Route::get('/about-us', function () {
            return view('pages.19-about-us');
        })->name('about-page');

        // Our Pools (comparison)
        Route::get('/our-pools', function () {
            return view('pages.02-pool-type-main');
        })->name('our-pools-main');

        // Concrete Pools
        Route::get('/concrete-pools', function () {
            return view('pages.03-pool-type-concrete');
        })->name('concrete-pools-page');

        // Vinyl Pools
        Route::get('/vinyl-pools', function () {
            return view('pages.04-pool-type-vinyl');
        })->name('vinyl-pools-page');

        // Fibreglass Pools
        Route::get('/fibreglass-pools', function () {
            return view('pages.05-pool-type-fibreglass');
        })->name('fibreglass-pools-page');

        // Pool Services
        Route::get('/our-pool-services', function () {
            return view('pages.06-pool-services');
        })->name('pool-services-page');

        // Pool Items & Equipment
        Route::get('/pool-items-equipments', function () {
            return view('pages.07-pool-essentials');
        })->name('pool-items-page');

        // Showcase Gallery
        Route::match(['get', 'post'], '/showcase', [ImageGalleryController::class, 'index'])->name('pool-showcase-gallery');

        // Projects
        Route::get('/projects', [ProjectController::class, 'index'])->name('projects-page');
        Route::get('/projects/{slug}', [ProjectController::class, 'show'])->name('project-detail-page');

        // Reviews
        Route::match(['get', 'post'], '/reviews', [ReviewController::class, 'index'])->name('customer-reviews-page');

        // Contact
        Route::get('/contact-us', function () {
            return view('pages.10-contact-us');
        })->name('contact-page');

        // FAQ
        Route::get('/faq', function () {
            return view('pages.11-faq');
        })->name('faq-page');

        // Promotions
        Route::get('/promotions', [PromotionController::class, 'index'])->name('promo-page');

        // Terms
        Route::get('/terms', function () {
            return view('pages.13-terms');
        })->name('terms-page');

        // Privacy
        Route::get('/privacy', function () {
            return view('pages.14-privacy');
        })->name('privacy-page');

        // HTML Sitemap
        Route::get('/sitemap', function () {
            return view('pages.16-sitemap');
        })->name('sitemap-page');
    });

// ─── 301 redirects from old unprefixed URLs → /en equivalent ─────────────────

foreach ([
    '/about-us',
    '/our-pools',
    '/concrete-pools',
    '/vinyl-pools',
    '/fibreglass-pools',
    '/our-pool-services',
    '/pool-items-equipments',
    '/showcase',
    '/projects',
    '/projects/{slug}',
    '/reviews',
    '/contact-us',
    '/faq',
    '/promotions',
    '/terms',
    '/privacy',
    '/sitemap',
] as $legacyPath) {
    Route::get($legacyPath, $redirectToEnglish);
}
