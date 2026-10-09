<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\ContactSubmission;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class ContactSubmissionPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_contact::submission');
    }

    public function view(AuthUser $authUser, ContactSubmission $contactSubmission): bool
    {
        return $authUser->can('view_contact::submission');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_contact::submission');
    }

    public function update(AuthUser $authUser, ContactSubmission $contactSubmission): bool
    {
        return $authUser->can('update_contact::submission');
    }

    public function delete(AuthUser $authUser, ContactSubmission $contactSubmission): bool
    {
        return $authUser->can('delete_contact::submission');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_contact::submission');
    }

    public function restore(AuthUser $authUser, ContactSubmission $contactSubmission): bool
    {
        return $authUser->can('restore_contact::submission');
    }

    public function forceDelete(AuthUser $authUser, ContactSubmission $contactSubmission): bool
    {
        return $authUser->can('force_delete_contact::submission');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_contact::submission');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_contact::submission');
    }

    public function replicate(AuthUser $authUser, ContactSubmission $contactSubmission): bool
    {
        return $authUser->can('replicate_contact::submission');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_contact::submission');
    }
}
