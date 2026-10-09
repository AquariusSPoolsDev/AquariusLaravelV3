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

// ─── Old v2 subdomain → same path on the main domain ─────────────────────────
// Registered first: routes without a domain would otherwise match v2 requests too.
// The main domain then applies its own redirects (/ → /en, old URLs → /en/...).

Route::domain('v2.aquariusswimmingpools.com')->group(function (): void {
    Route::get('/{path?}', function (Request $request): RedirectResponse {
        $query = $request->getQueryString();

        return redirect()->away('https://aquariusswimmingpools.com'.$request->getPathInfo().($query ? '?'.$query : ''), 301);
    })->where('path', '.*');
});

// ─── Utility routes (no locale prefix) ───────────────────────────────────────

Route::get('/sitemap.xml', [SitemapController::class, 'index'])->name('sitemap-xml');

// 5 attempts per IP per hour: enough to fix validation errors or share an office network.
// The honeypot and 24-hour duplicate-email check in the controller handle spam.
Route::post('/send-email', [ContactFormController::class, 'sendEmail'])
    ->middleware('throttle:5,60')
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

// ─── 301 redirects from the original site's URLs → their /en page in one hop ──

foreach ([
    '/our-pools/concrete-pools' => '/en/concrete-pools',
    '/our-pools/vinyl-pools' => '/en/vinyl-pools',
    '/our-pools/fiberglass-pools' => '/en/fibreglass-pools',
    '/pool-gallery' => '/en/showcase',
    '/services' => '/en/our-pool-services',
    '/services/our-services' => '/en/our-pool-services',
    '/services/pool-items' => '/en/pool-items-equipments',
    '/contact' => '/en/contact-us',
    '/contact/faq' => '/en/faq',
    '/legal' => '/en/terms',
    '/legal/terms-and-conditions' => '/en/terms',
    '/legal/privacy-policy' => '/en/privacy',
    '/promotions.php' => '/en/promotions',
] as $oldPath => $newPath) {
    Route::get($oldPath, function (Request $request) use ($newPath): RedirectResponse {
        $query = $request->getQueryString();

        return redirect($newPath.($query ? '?'.$query : ''), 301);
    });
}

// The online shop lives on its own site; a temporary redirect in case its address changes.
Route::get('/services/pool-shop', fn (): RedirectResponse => redirect()->away('https://thesplashshop.com'));
