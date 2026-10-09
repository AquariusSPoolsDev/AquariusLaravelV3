<?php

namespace Tests\Feature;

use App\Filament\Pages\Auth\EditProfile;
use App\Models\User;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Livewire\Livewire;
use Tests\TestCase;

/**
 * phpunit.xml points at the development MySQL database. Every test runs inside a transaction
 * that is rolled back afterwards, so the throwaway user and its changes are never kept.
 */
class EditProfilePageTest extends TestCase
{
    use DatabaseTransactions;

    private User $user;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel('admin');

        // The users table has no email_verified_at column, so the default factory cannot insert.
        $this->user = User::query()->create([
            'name' => 'Profile Tester',
            'email' => 'profile-tester@aquariusswimmingpools.com',
            'password' => 'password',
        ]);
        $this->user->assignRole('Staff');

        $this->actingAs($this->user);
    }

    public function test_profile_page_shows_every_section(): void
    {
        $this->get(EditProfile::getUrl())
            ->assertOk()
            ->assertSee('My profile')
            ->assertSee('PT')
            ->assertSee('Staff')
            ->assertSee('Account details')
            ->assertSee('Your activity')
            ->assertSee('Change password')
            ->assertSee('What you can access')
            ->assertSee('Logged-in devices');
    }

    public function test_access_list_reflects_the_role(): void
    {
        Livewire::test(EditProfile::class)
            ->assertSeeHtml('<span>Contact Submission</span>')
            ->assertSeeHtml('<span class="sr-only">No access: </span>Users');
    }

    public function test_name_can_be_updated(): void
    {
        Livewire::test(EditProfile::class)
            ->fillForm(['name' => 'Renamed Tester'])
            ->call('save')
            ->assertHasNoFormErrors();

        $this->assertSame('Renamed Tester', $this->user->fresh()->name);
    }

    public function test_email_must_stay_on_a_company_domain(): void
    {
        Livewire::test(EditProfile::class)
            ->fillForm(['email' => 'someone@gmail.com', 'currentPassword' => 'password'])
            ->call('save')
            ->assertHasFormErrors(['email' => 'ends_with']);

        $this->assertSame('profile-tester@aquariusswimmingpools.com', $this->user->fresh()->email);
    }

    public function test_changing_email_requires_the_current_password(): void
    {
        Livewire::test(EditProfile::class)
            ->fillForm(['email' => 'renamed-tester@aquariusswimmingpools.com'])
            ->call('save')
            ->assertHasFormErrors(['currentPassword' => 'required']);
    }

    public function test_password_can_be_changed_with_the_current_password(): void
    {
        Livewire::test(EditProfile::class)
            ->fillForm([
                'currentPassword' => 'password',
                'password' => 'NewSecret123!',
                'passwordConfirmation' => 'NewSecret123!',
            ], 'passwordForm')
            ->call('updatePassword')
            ->assertHasNoFormErrors([], 'passwordForm')
            ->assertNotified('Password updated');

        $this->assertTrue(Hash::check('NewSecret123!', $this->user->fresh()->password));
    }

    public function test_password_change_rejects_a_wrong_current_password(): void
    {
        Livewire::test(EditProfile::class)
            ->fillForm([
                'currentPassword' => 'wrong-password',
                'password' => 'NewSecret123!',
                'passwordConfirmation' => 'NewSecret123!',
            ], 'passwordForm')
            ->call('updatePassword')
            ->assertHasFormErrors(['currentPassword' => 'current_password'], 'passwordForm');

        $this->assertTrue(Hash::check('password', $this->user->fresh()->password));
    }

    public function test_log_out_other_devices_removes_other_sessions(): void
    {
        // phpunit.xml uses the array session driver; the device list reads the sessions table directly.
        config(['session.driver' => 'database']);

        DB::table('sessions')->insert([
            'id' => 'other-device-session',
            'user_id' => $this->user->id,
            'ip_address' => '10.0.0.5',
            'user_agent' => 'Mozilla/5.0 (iPhone; CPU iPhone OS 17_0 like Mac OS X) Safari/604.1',
            'payload' => '',
            'last_activity' => now()->subDays(2)->timestamp,
        ]);

        Livewire::test(EditProfile::class)
            ->assertSee('Safari · iOS')
            ->callAction('logOutOtherDevices', ['currentPassword' => 'password'])
            ->assertHasNoFormErrors()
            ->assertNotified('Other devices logged out');

        $this->assertDatabaseMissing('sessions', ['id' => 'other-device-session']);
    }
}
