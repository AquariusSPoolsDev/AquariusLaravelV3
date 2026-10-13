<?php

use App\Http\Middleware\EnsureSitePageIsVisible;
use App\Http\Middleware\LocalizationMiddleware;
use Illuminate\Foundation\Application;
use Illuminate\Foundation\Configuration\Exceptions;
use Illuminate\Foundation\Configuration\Middleware;
use Illuminate\Http\Request;

return Application::configure(basePath: dirname(__DIR__))
    ->withRouting(
        web: __DIR__.'/../routes/web.php',
        commands: __DIR__.'/../routes/console.php',
        health: '/up',
    )
    ->withMiddleware(function (Middleware $middleware) {
        // Cloudflare reaches the server over plain HTTP and reports the visitor's scheme in X-Forwarded-Proto.
        // Only that header is trusted: client IPs already arrive correctly, and trusting X-Forwarded-For
        // would let anyone fake their IP past the login and contact-form rate limits.
        $middleware->trustProxies(at: '*', headers: Request::HEADER_X_FORWARDED_PROTO);

        $middleware->web(append: [
            LocalizationMiddleware::class,
        ]);

        $middleware->alias([
            'site.page' => EnsureSitePageIsVisible::class,
        ]);
    })
    ->withExceptions(function (Exceptions $exceptions) {
        //
    })->create();
