<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

/**
 * Keeps the admin subdomain (config app.admin_url) to admin pages only.
 *
 * The same app also holds the public website, so without this the public pages would be
 * reachable (and indexable) on the admin subdomain too. Does nothing when no admin URL is set.
 */
class AdminDomain
{
    /**
     * Host name of the admin subdomain, or null when the admin panel lives at /admin.
     */
    public static function host(): ?string
    {
        $adminUrl = config('app.admin_url');

        return $adminUrl ? parse_url($adminUrl, PHP_URL_HOST) : null;
    }

    public function handle(Request $request, Closure $next): Response
    {
        $host = self::host();

        if (! $host || $request->getHost() !== $host) {
            return $next($request);
        }

        $isAdminRequest = $request->route()?->named('filament.*') || $request->is('livewire/*');

        abort_unless($isAdminRequest, 404);

        $response = $next($request);
        $response->headers->set('X-Robots-Tag', 'noindex, nofollow');

        return $response;
    }
}
