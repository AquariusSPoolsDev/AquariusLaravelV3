<?php

use App\Http\Controllers\ContactFormController;
use App\Http\Controllers\ImageGalleryController;
use App\Http\Controllers\localeController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\Route;

// CHANGE LANGUAGE
Route::get('{lang}', [localeController::class, 'setLocale'])->where('lang', 'en|ms');
Route::post('change-language', [localeController::class, 'setLocale']);

// 1. HOMEPAGE
Route::get('/', function () {
    return view('pages.01-homepage');
})->name('homepage');

// 2. OUR POOLS (WITH COMPARASION)
Route::get('/our-pools', function () {
    return view('pages.02-pool-type-main');
})->name('our-pools-main');

// 3. CONCRETE POOL
Route::get('/concrete-pools', function () {
    return view('pages.03-pool-type-concrete');
})->name('concrete-pools-page');

// 4. VINYL POOL
Route::get('/vinyl-pools', function () {
    return view('pages.04-pool-type-vinyl');
})->name('vinyl-pools-page');

// 5. FIBREGLASS POOL
Route::get('/fibreglass-pools', function () {
    return view('pages.05-pool-type-fibreglass');
})->name('fibreglass-pools-page');

// 6. OUR POOL SERVICES
Route::get('/our-pool-services', function () {
    return view('pages.06-pool-services');
})->name('pool-services-page');

// 7. POOL ITEMS & EQUIPMENTS
Route::get('/pool-items-equipments', function () {
    return view('pages.07-pool-essentials');
})->name('pool-items-page');

// 8. SHOWCASE
Route::match(['get', 'post'], '/showcase', [ImageGalleryController::class, 'index'])->name('pool-showcase-gallery');

// 9. REVIEWS
Route::match(['get', 'post'], '/reviews', [ReviewController::class, 'index'])->name('customer-reviews-page');

// 10. CONTACT
Route::get('/contact-us', function () {
    return view('pages.10-contact-us');
})->name('contact-page');

// 11. FAQ
Route::get('/faq', function () {
    return view('pages.11-faq');
})->name('faq-page');

// 12. PROMOTIONS
Route::get('/promotions', function () {
    return view('pages.12-promotions');
})->name('promo-page');

// 13. TERMS
Route::get('/terms', function () {
    return view('pages.13-terms');
})->name('terms-page');

// 14. PRIVACY
Route::get('/privacy', function () {
    return view('pages.14-privacy');
})->name('privacy-page');

// 15. SITEMAP
Route::get('/sitemap', function () {
    return view('pages.16-sitemap');
})->name('sitemap-page');

// ROUTE CONTACT SEND EMAIL
Route::post('/send-email', [ContactFormController::class, 'sendEmail'])
    ->middleware('throttle:1,60')
    ->name('send-email-page');

Route::get('/thank-you', function () {
    return view('pages.15-thankYouSubmitPage');
})->name('thank-you');

// ROUTE DISMISS NOTIFICATION
Route::post('/dismiss-promotion', function () {
    session(['promotion_dismissed' => true]); // Set session variable

    return response()->json(['success' => true]);
})->name('dismiss-promotion');

// REDIRECT ROUTE
Route::domain('v2.aquariusswimmingpools.com')->group(function () {
    Route::get('/', function () {
        return redirect()->route('homepage');
    });
});

// REDIRECT ROUTES

// Our Pools
Route::redirect('/our-pools/concrete-pools', '/concrete-pools', 301);
Route::redirect('/our-pools/concrete-pools/', '/concrete-pools', 301);
Route::redirect('/our-pools/vinyl-pools', '/vinyl-pools', 301);
Route::redirect('/our-pools/vinyl-pools/', '/vinyl-pools', 301);
Route::redirect('/our-pools/fiberglass-pools', '/fibreglass-pools', 301);
Route::redirect('/our-pools/fiberglass-pools/', '/fibreglass-pools', 301);

// Showcase / Gallery
Route::redirect('/pool-gallery', '/showcase', 301);
Route::redirect('/pool-gallery/', '/showcase', 301);

// Services
Route::redirect('/services', '/our-pool-services', 301);
Route::redirect('/services/', '/our-pool-services', 301);
Route::redirect('/services/our-services', '/our-pool-services', 301);
Route::redirect('/services/our-services/', '/our-pool-services', 301);
Route::redirect('/services/pool-items', '/pool-items-equipments', 301);
Route::redirect('/services/pool-items/', '/pool-items-equipments', 301);

// Pool Shop (external)
Route::get('/services/pool-shop', function () {
    return redirect()->away('https://thesplashshop.com');
});
Route::get('/services/pool-shop/', function () {
    return redirect()->away('https://thesplashshop.com');
});

// Contact
Route::redirect('/contact', '/contact-us', 301);
Route::redirect('/contact/', '/contact-us', 301);

// FAQ
Route::redirect('/contact/faq', '/faq', 301);
Route::redirect('/contact/faq/', '/faq', 301);

// Legal
Route::redirect('/legal', '/terms', 301);
Route::redirect('/legal/', '/terms', 301);
Route::redirect('/legal/terms-and-conditions', '/terms', 301);
Route::redirect('/legal/terms-and-conditions/', '/terms', 301);
Route::redirect('/legal/privacy-policy', '/privacy', 301);
Route::redirect('/legal/privacy-policy/', '/privacy', 301);

// Reviews (FIXED - was looping to itself)
// No redirect needed, /reviews is already a valid route

// Promotions
Route::redirect('/promotions.php', '/promotions', 301);
