<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\URL;
use Symfony\Component\HttpFoundation\Response;

class LocalizationMiddleware
{
    private const LOCALE_MAP = ['en' => 'en_MY', 'ms' => 'ms_MY'];

    public function handle(Request $request, Closure $next): Response
    {
        $urlSegment = $request->segment(1);

        if (isset(self::LOCALE_MAP[$urlSegment])) {
            // URL-prefixed route: /en/... or /ms/...
            $shortLocale = $urlSegment;
        } else {
            // Non-prefixed route (sitemap.xml, thank-you, etc.): fall back to session
            $fullLocale = Session::get('locale', 'en_MY');
            $shortLocale = (string) (array_search($fullLocale, self::LOCALE_MAP) ?: 'en');
        }

        $fullLocale = self::LOCALE_MAP[$shortLocale];
        App::setLocale($fullLocale);
        Session::put('locale', $fullLocale);

        // Bind locale as URL default so route() calls auto-include it
        URL::defaults(['locale' => $shortLocale]);

        return $next($request);
    }
}
