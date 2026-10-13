<?php

namespace Tests\Feature;

use Illuminate\Http\Middleware\TrustProxies;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;
use Tests\TestCase;

/**
 * Cloudflare reaches the live server over plain HTTP and sends the visitor's scheme in
 * X-Forwarded-Proto. Without trusting it, redirects and signed upload URLs come out as http://.
 */
class HttpsBehindCloudflareTest extends TestCase
{
    public function test_admin_redirect_stays_on_https_behind_cloudflare(): void
    {
        $this->get('http://aquariusswimmingpools.com/admin', ['X-Forwarded-Proto' => 'https'])
            ->assertRedirect('https://aquariusswimmingpools.com/admin/login');
    }

    public function test_plain_http_without_the_header_is_left_alone(): void
    {
        $this->get('http://aquariusswimmingpools.com/admin')
            ->assertRedirect('http://aquariusswimmingpools.com/admin/login');
    }

    public function test_forwarded_ip_is_not_trusted(): void
    {
        $request = Request::create('http://aquariusswimmingpools.com/admin', 'GET', server: [
            'REMOTE_ADDR' => '203.0.113.5',
            'HTTP_X_FORWARDED_FOR' => '198.51.100.9',
            'HTTP_X_FORWARDED_PROTO' => 'https',
        ]);

        app(TrustProxies::class)->handle($request, function (Request $request): Response {
            $this->assertTrue($request->isSecure());
            $this->assertSame('203.0.113.5', $request->ip());

            return new Response;
        });
    }
}
