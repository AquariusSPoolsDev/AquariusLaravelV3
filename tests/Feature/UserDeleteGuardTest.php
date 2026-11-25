<?php

namespace Tests\Feature;

use App\Filament\Resources\UserResource\Pages\EditUser;
use App\Models\User;
use Filament\Actions\DeleteAction;
use Filament\Facades\Filament;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use Livewire\Livewire;
use Spatie\Permission\Models\Role;
use Tests\TestCase;

/**
 * Deleting a user is permanent, so the Delete button is blocked on your own account and on the
 * last Admin. Other accounts can still be deleted by an Admin.
 *
 * phpunit.xml points at the development MySQL database. The throwaway users are rolled back with
 * each test's transaction, and every test leaves the existing accounts as they were.
 */
class UserDeleteGuardTest extends TestCase
{
    use DatabaseTransactions;

    protected function setUp(): void
    {
        parent::setUp();

        Filament::setCurrentPanel('admin');

        if (! Role::where('name', 'Admin')->exists()) {
            $this->markTestSkipped('The Admin role is not in this database.');
        }
    }

    private function makeUser(string $email, ?string $role = null): User
    {
        // The users table has no email_verified_at column, so the default factory cannot insert.
        $user = User::query()->create(['name' => 'Delete Guard Tester', 'email' => $email, 'password' => 'password']);

        if ($role) {
            $user->assignRole($role);
        }

        return $user;
    }

    /**
     * Leaves exactly one Admin in the database (a throwaway one) and returns it.
     */
    private function onlyOneAdmin(): User
    {
        foreach (User::role('Admin')->get() as $admin) {
            $admin->removeRole('Admin');
        }

        return $this->makeUser('last-admin@aquariusswimmingpools.com', 'Admin');
    }

    public function test_an_admin_cannot_delete_their_own_account(): void
    {
        $admin = $this->makeUser('self-delete@aquariusswimmingpools.com', 'Admin');
        $this->makeUser('second-admin@aquariusswimmingpools.com', 'Admin');
        $this->actingAs($admin);

        $this->assertFalse($admin->can('delete', $admin));
        Livewire::test(EditUser::class, ['record' => $admin->getRouteKey()])
            ->assertActionHidden(DeleteAction::class);
    }

    public function test_the_last_admin_cannot_be_deleted(): void
    {
        $lastAdmin = $this->onlyOneAdmin();

        // Someone allowed to delete users, but not an Admin, so it is not their own account either.
        $deleter = $this->makeUser('deleter@aquariusswimmingpools.com');
        $deleter->givePermissionTo(['view_any_user', 'view_user', 'update_user', 'delete_user']);
        $this->actingAs($deleter);

        $this->assertFalse($deleter->can('delete', $lastAdmin));
        Livewire::test(EditUser::class, ['record' => $lastAdmin->getRouteKey()])
            ->assertActionHidden(DeleteAction::class);
    }

    public function test_an_admin_can_delete_another_admin_when_one_would_remain(): void
    {
        $admin = $this->makeUser('keeps-access@aquariusswimmingpools.com', 'Admin');
        $otherAdmin = $this->makeUser('other-admin@aquariusswimmingpools.com', 'Admin');
        $this->actingAs($admin);

        Livewire::test(EditUser::class, ['record' => $otherAdmin->getRouteKey()])
            ->assertActionVisible(DeleteAction::class)
            ->callAction(DeleteAction::class);

        $this->assertModelMissing($otherAdmin);
    }

    public function test_an_admin_can_delete_a_staff_account(): void
    {
        $admin = $this->makeUser('staff-remover@aquariusswimmingpools.com', 'Admin');
        $staff = $this->makeUser('old-staff@aquariusswimmingpools.com', 'Staff');
        $this->actingAs($admin);

        Livewire::test(EditUser::class, ['record' => $staff->getRouteKey()])
            ->callAction(DeleteAction::class);

        $this->assertModelMissing($staff);
    }

    public function test_staff_cannot_delete_anyone(): void
    {
        $staff = $this->makeUser('staff-member@aquariusswimmingpools.com', 'Staff');
        $other = $this->makeUser('another-staff@aquariusswimmingpools.com', 'Staff');

        $this->assertFalse($staff->can('delete', $other));
    }
}
