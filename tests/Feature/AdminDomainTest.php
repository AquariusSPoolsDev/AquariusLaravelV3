<?php

namespace Tests\Feature;

use App\Enums\SitePage;
use App\Http\Middleware\AdminDomain;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * The admin subdomain runs the same app as the public website. Only admin pages may answer there.
 *
 * The panel itself is registered at boot (at /admin in tests, as ADMIN_URL is unset), so these tests
 * cover the request-time guard by setting app.admin_url per test.
 *
 * phpunit.xml points at the development MySQL database. Page switches are only changed inside a
 * transaction that is rolled back afterwards.
 */
class AdminDomainTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        SitePage::Faq->setVisible(true);
    }

    public function test_no_admin_host_when_admin_url_is_not_set(): void
    {
        config(['app.admin_url' => null]);

        $this->assertNull(AdminDomain::host());
    }

    public function test_admin_host_comes_from_the_admin_url(): void
    {
        config(['app.admin_url' => 'https://admin.aquariusswimmingpools.com']);

        $this->assertSame('admin.aquariusswimmingpools.com', AdminDomain::host());
    }

    public function test_public_pages_are_not_found_on_the_admin_subdomain(): void
    {
        config(['app.admin_url' => 'https://admin.aquariusswimmingpools.com']);

        $this->get('https://admin.aquariusswimmingpools.com/en/faq')->assertNotFound();
        $this->get('https://admin.aquariusswimmingpools.com/sitemap.xml')->assertNotFound();
    }

    public function test_admin_pages_answer_on_the_admin_subdomain_and_are_not_indexed(): void
    {
        config(['app.admin_url' => 'https://admin.aquariusswimmingpools.com']);

        $this->get('https://admin.aquariusswimmingpools.com/admin/login')
            ->assertOk()
            ->assertHeader('X-Robots-Tag', 'noindex, nofollow');
    }

    public function test_main_site_is_unaffected(): void
    {
        config(['app.admin_url' => 'https://admin.aquariusswimmingpools.com']);

        $this->get('https://aquariusswimmingpools.com/en/faq')
            ->assertOk()
            ->assertHeaderMissing('X-Robots-Tag');
    }

    public function test_nothing_is_blocked_without_an_admin_url(): void
    {
        config(['app.admin_url' => null]);

        $this->get('https://admin.aquariusswimmingpools.com/en/faq')->assertOk();
    }
}
