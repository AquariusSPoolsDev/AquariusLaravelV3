<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\Promotion;
use Illuminate\Auth\Access\HandlesAuthorization;

class PromotionPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_promotion');
    }

    public function view(AuthUser $authUser, Promotion $promotion): bool
    {
        return $authUser->can('view_promotion');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_promotion');
    }

    public function update(AuthUser $authUser, Promotion $promotion): bool
    {
        return $authUser->can('update_promotion');
    }

    public function delete(AuthUser $authUser, Promotion $promotion): bool
    {
        return $authUser->can('delete_promotion');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_promotion');
    }

    public function restore(AuthUser $authUser, Promotion $promotion): bool
    {
        return $authUser->can('restore_promotion');
    }

    public function forceDelete(AuthUser $authUser, Promotion $promotion): bool
    {
        return $authUser->can('force_delete_promotion');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_promotion');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_promotion');
    }

    public function replicate(AuthUser $authUser, Promotion $promotion): bool
    {
        return $authUser->can('replicate_promotion');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_promotion');
    }

}