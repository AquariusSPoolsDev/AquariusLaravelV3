<?php

namespace App\Policies;

use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class UserPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_user');
    }

    public function view(AuthUser $authUser): bool
    {
        return $authUser->can('view_user');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_user');
    }

    public function update(AuthUser $authUser): bool
    {
        return $authUser->can('update_user');
    }

    /**
     * Deleting is permanent, so nobody can delete their own account or the last Admin:
     * either would leave the admin panel with no one to manage users.
     */
    public function delete(AuthUser $authUser, User $user): bool
    {
        if (! $authUser->can('delete_user') || $authUser->is($user)) {
            return false;
        }

        return ! ($user->hasRole('Admin') && User::role('Admin')->count() <= 1);
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_user');
    }

    public function restore(AuthUser $authUser): bool
    {
        return $authUser->can('restore_user');
    }

    public function forceDelete(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_user');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_user');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_user');
    }

    public function replicate(AuthUser $authUser): bool
    {
        return $authUser->can('replicate_user');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_user');
    }
}
