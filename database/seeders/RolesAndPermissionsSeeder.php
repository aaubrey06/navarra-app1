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
        $storemanager = Role::create(['name' => 'store manager']);
        $warehousemanager = Role::create(['name' => 'warehouse manager']);
        $driver = Role::create(['name' => 'driver']);
        $customer = Role::create(['name' => 'customer']);
        $superAdminRole = Role::create(['name' => 'superadmin']);

        // Create permissions
        $createUserPermission = Permission::create(['name' => 'create user']);
        $editUserPermission = Permission::create(['name' => 'edit user']);
        $deleteUserPermission = Permission::create(['name' => 'delete user']);
        $manageRolesPermission = Permission::create(['name' => 'manage roles']);
        $managePermissionsPermission = Permission::create(['name' => 'manage permissions']);

        // Assign permissions to roles
        $superAdminRole->givePermissionTo($createUserPermission);
        $superAdminRole->givePermissionTo($editUserPermission);
        $superAdminRole->givePermissionTo($deleteUserPermission);
        $superAdminRole->givePermissionTo($manageRolesPermission);
        $superAdminRole->givePermissionTo($managePermissionsPermission);
    }
}
