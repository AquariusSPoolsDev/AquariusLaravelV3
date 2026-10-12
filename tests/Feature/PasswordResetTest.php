<?php

namespace Tests\Feature;

use App\Models\User;
use Filament\Auth\Notifications\ResetPassword;
use Filament\Auth\Pages\PasswordReset\RequestPasswordReset;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Notification;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * phpunit.xml points at the development MySQL database. Every test runs inside a transaction
 * that is rolled back afterwards, so the throwaway user and its reset token are never kept.
 */
class PasswordResetTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel('admin');
        Notification::fake();
    }

    public function test_requesting_a_reset_link_stores_a_token_and_emails_the_user(): void
    {
        // The users table has no email_verified_at column, so the default factory cannot insert.
        $user = User::query()->create([
            'name' => 'Reset Tester',
            'email' => 'reset-tester@aquariusswimmingpools.com',
            'password' => 'password',
        ]);

        Livewire::test(RequestPasswordReset::class)
            ->fillForm(['email' => $user->email])
            ->call('request')
            ->assertHasNoFormErrors()
            ->assertNotified();

        $this->assertDatabaseHas('password_reset_tokens', ['email' => $user->email]);
        Notification::assertSentTo($user, ResetPassword::class);
    }

    public function test_unknown_email_does_not_store_a_token(): void
    {
        Livewire::test(RequestPasswordReset::class)
            ->fillForm(['email' => 'nobody@aquariusswimmingpools.com'])
            ->call('request')
            ->assertNotified();

        $this->assertSame(0, DB::table('password_reset_tokens')->where('email', 'nobody@aquariusswimmingpools.com')->count());
        Notification::assertNothingSent();
    }

    public function test_forgot_password_page_loads(): void
    {
        $this->get(Filament::getPanel('admin')->getRequestPasswordResetUrl())->assertOk();
    }
}
