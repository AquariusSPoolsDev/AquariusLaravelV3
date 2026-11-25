<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Tests\TestCase;

/**
 * When a user's password changes (a reset, or an Admin setting a new one), their other logged-in
 * sessions are signed out on the next page load and sent to the admin login page.
 *
 * phpunit.xml points at the development MySQL database; nothing is written here.
 */
class AdminSessionTest extends TestCase
{
    use DatabaseTransactions;

    private User $admin;

    protected function setUp(): void
    {
        parent::setUp();

        $admin = User::query()->where('email', 'admin@aquariusswimmingpools.com')->first();

        if (! $admin) {
            $this->markTestSkipped('The seeded admin user is not in this database.');
        }

        $this->admin = $admin;
        Filament::setCurrentPanel('admin');
    }

    public function test_a_session_from_before_a_password_change_goes_to_the_admin_login_page(): void
    {
        // The session remembers a hash of the old password, so it no longer matches.
        $this->actingAs($this->admin)
            ->withSession(['password_hash_web' => 'hash-of-the-old-password'])
            ->get(route('filament.admin.pages.dashboard'))
            ->assertRedirect(Filament::getLoginUrl());

        $this->assertGuest();
    }

    public function test_a_session_with_the_current_password_stays_signed_in(): void
    {
        $this->actingAs($this->admin)
            ->get(route('filament.admin.pages.dashboard'))
            ->assertOk();

        $this->assertAuthenticatedAs($this->admin);
    }
}
