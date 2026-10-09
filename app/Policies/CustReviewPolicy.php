<?php

declare(strict_types=1);

namespace App\Policies;

use App\Models\CustReview;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Foundation\Auth\User as AuthUser;

class CustReviewPolicy
{
    use HandlesAuthorization;

    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_cust::review');
    }

    public function view(AuthUser $authUser, CustReview $custReview): bool
    {
        return $authUser->can('view_cust::review');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_cust::review');
    }

    public function update(AuthUser $authUser, CustReview $custReview): bool
    {
        return $authUser->can('update_cust::review');
    }

    public function delete(AuthUser $authUser, CustReview $custReview): bool
    {
        return $authUser->can('delete_cust::review');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_cust::review');
    }

    public function restore(AuthUser $authUser, CustReview $custReview): bool
    {
        return $authUser->can('restore_cust::review');
    }

    public function forceDelete(AuthUser $authUser, CustReview $custReview): bool
    {
        return $authUser->can('force_delete_cust::review');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_cust::review');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_cust::review');
    }

    public function replicate(AuthUser $authUser, CustReview $custReview): bool
    {
        return $authUser->can('replicate_cust::review');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_cust::review');
    }
}
