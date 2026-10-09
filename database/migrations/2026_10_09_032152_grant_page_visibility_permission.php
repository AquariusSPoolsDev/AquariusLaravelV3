<?php

use Illuminate\Database\Migrations\Migration;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;

/**
 * Lets Admin and Staff open the admin panel's Page Visibility screen.
 */
return new class extends Migration
{
    private const PERMISSION = 'page_PageVisibility';

    private const GUARD = 'web';

    public function up(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        $permission = Permission::findOrCreate(self::PERMISSION, self::GUARD);

        Role::query()
            ->where('guard_name', self::GUARD)
            ->whereIn('name', ['Admin', 'Staff'])
            ->get()
            ->each(fn (Role $role) => $role->givePermissionTo($permission));

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }

    public function down(): void
    {
        app(PermissionRegistrar::class)->forgetCachedPermissions();

        Permission::query()
            ->where('name', self::PERMISSION)
            ->where('guard_name', self::GUARD)
            ->delete();

        app(PermissionRegistrar::class)->forgetCachedPermissions();
    }
};
