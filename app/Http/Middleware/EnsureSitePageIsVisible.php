<?php

namespace App\Http\Middleware;

use App\Enums\SitePage;
use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Returns 404 for a page switched off on the admin panel's Page Visibility screen.
 * Applied to the whole {locale} route group; the page is looked up from the route name.
 */
class EnsureSitePageIsVisible
{
    public function handle(Request $request, Closure $next): Response
    {
        $page = SitePage::forRoute($request->route()?->getName());

        abort_if($page && ! $page->isVisible(), 404);

        return $next($request);
    }
}
