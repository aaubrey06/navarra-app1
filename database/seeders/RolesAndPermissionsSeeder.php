<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RolesAndPermissionsSeeder extends Seeder
{
    public function run()
    {
        // Create roles
        $owner = Role::create(['name' => 'owner']);
        $store_manager = Role::create(['name' => 'store manager']);
        $warehouse_manager= Role::create(['name' => 'warehouse manager']);
        $driver = Role::create(['name' => 'driver']);
        $customer = Role::create(['name' => 'customer']);
        $superAdmin = Role::create(['name' => 'superadmin']);

        // Create permissions
        $createUserPermission = Permission::create(['name' => 'create user']);
        $editUserPermission = Permission::create(['name' => 'edit user']);
        $deleteUserPermission = Permission::create(['name' => 'delete user']);
        $manageRolesPermission = Permission::create(['name' => 'manage roles']);
        $managePermissionsPermission = Permission::create(['name' => 'manage permissions']);

        // Assign permissions to roles
        $superAdmin->givePermissionTo($createUserPermission);
        $superAdmin->givePermissionTo($editUserPermission);
        $superAdmin->givePermissionTo($deleteUserPermission);
        $superAdmin->givePermissionTo($manageRolesPermission);
        $superAdmin->givePermissionTo($managePermissionsPermission);
    }
}
