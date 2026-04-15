<?php

declare(strict_types=1);

namespace App\Policies;

use Illuminate\Foundation\Auth\User as AuthUser;
use App\Models\ImageGallery;
use Illuminate\Auth\Access\HandlesAuthorization;

class ImageGalleryPolicy
{
    use HandlesAuthorization;
    
    public function viewAny(AuthUser $authUser): bool
    {
        return $authUser->can('view_any_image::gallery');
    }

    public function view(AuthUser $authUser, ImageGallery $imageGallery): bool
    {
        return $authUser->can('view_image::gallery');
    }

    public function create(AuthUser $authUser): bool
    {
        return $authUser->can('create_image::gallery');
    }

    public function update(AuthUser $authUser, ImageGallery $imageGallery): bool
    {
        return $authUser->can('update_image::gallery');
    }

    public function delete(AuthUser $authUser, ImageGallery $imageGallery): bool
    {
        return $authUser->can('delete_image::gallery');
    }

    public function deleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('delete_any_image::gallery');
    }

    public function restore(AuthUser $authUser, ImageGallery $imageGallery): bool
    {
        return $authUser->can('restore_image::gallery');
    }

    public function forceDelete(AuthUser $authUser, ImageGallery $imageGallery): bool
    {
        return $authUser->can('force_delete_image::gallery');
    }

    public function forceDeleteAny(AuthUser $authUser): bool
    {
        return $authUser->can('force_delete_any_image::gallery');
    }

    public function restoreAny(AuthUser $authUser): bool
    {
        return $authUser->can('restore_any_image::gallery');
    }

    public function replicate(AuthUser $authUser, ImageGallery $imageGallery): bool
    {
        return $authUser->can('replicate_image::gallery');
    }

    public function reorder(AuthUser $authUser): bool
    {
        return $authUser->can('reorder_image::gallery');
    }

}