<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Collection;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Brings Shield permissions in line with the admin panel's resources:
 * - creates permissions for Contact Submissions, Customer Reviews and Projects (their policies were missing),
 * - removes leftovers: the old `*_review` permissions (legacy Review model) and every `web2` guard copy,
 * - Admin gets every permission; Staff gets all content permissions except force-deletes, and none for Users or Roles.
 */
return new class extends Migration
{
    private const GUARD = 'web';

    private const POLICY_ACTIONS = [
        'view', 'view_any', 'create', 'update', 'delete', 'delete_any',
        'restore', 'restore_any', 'replicate', 'reorder', 'force_delete', 'force_delete_any',
    ];

    private const NEW_SUBJECTS = ['contact::submission', 'cust::review', 'project'];

    private const STAFF_SUBJECTS = ['image::gallery', 'promotion', 'contact::submission', 'cust::review', 'project'];

    private const STAFF_EXTRA_PERMISSIONS = [
        'page_Dashboard',
        'widget_ImageGalleryWidget',
        'widget_PromotionsWidget',
        'widget_ReviewsWidget',
    ];

    public function up(): void
    {
        $this->forgetCachedPermissions();

        Permission::query()->where('guard_name', 'web2')->delete();
        Permission::query()
            ->where('guard_name', self::GUARD)
            ->whereIn('name', $this->permissionsFor(['review']))
            ->delete();

        $this->permissionsFor(self::NEW_SUBJECTS)
            ->merge(self::STAFF_EXTRA_PERMISSIONS)
            ->each(fn (string $name): Permission => Permission::findOrCreate($name, self::GUARD));

        Role::query()
            ->where('name', 'Admin')
            ->where('guard_name', self::GUARD)
            ->first()
            ?->syncPermissions(Permission::query()->where('guard_name', self::GUARD)->get());

        Role::query()
            ->where('name', 'Staff')
            ->where('guard_name', self::GUARD)
            ->first()
            ?->syncPermissions(
                $this->permissionsFor(self::STAFF_SUBJECTS)
                    ->reject(fn (string $name): bool => str_starts_with($name, 'force_delete'))
                    ->merge(self::STAFF_EXTRA_PERMISSIONS)
                    ->map(fn (string $name): Permission => Permission::findOrCreate($name, self::GUARD))
            );

        $this->forgetCachedPermissions();
    }

    /**
     * Removes the permissions this migration created. The deleted legacy `*_review` and `web2` permissions
     * controlled nothing in the panel, so they are not recreated.
     */
    public function down(): void
    {
        $this->forgetCachedPermissions();

        Permission::query()
            ->where('guard_name', self::GUARD)
            ->whereIn('name', $this->permissionsFor(self::NEW_SUBJECTS))
            ->delete();

        $this->forgetCachedPermissions();
    }

    /**
     * @param  array<int, string>  $subjects
     * @return Collection<int, string>
     */
    private function permissionsFor(array $subjects): Collection
    {
        return collect($subjects)->crossJoin(self::POLICY_ACTIONS)
            ->map(fn (array $pair): string => "{$pair[1]}_{$pair[0]}");
    }

    private function forgetCachedPermissions(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
};
