<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use Spatie\Permission\PermissionRegistrar;
class PermissionSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        app()[PermissionRegistrar::class]->forgetCachedPermissions();

        // create permissions
        $superAdminRole = Role::create(['name' => 'superadmin']);
        $vendorRole     = Role::create(['name' => 'vendor']);
        $registerRole   = Role::create(['name' => 'client']);

        Permission::create(['name' => 'add user','module'=>'user']);
        Permission::create(['name' => 'edit user','module'=>'user']);
        Permission::create(['name' => 'delete user','module'=>'user']);
        Permission::create(['name' => 'view user','module'=>'user']);

        Permission::create(['name' => 'add product','module'=>'product']);
        Permission::create(['name' => 'edit product','module'=>'product']);
        Permission::create(['name' => 'delete product','module'=>'product']);
        Permission::create(['name' => 'view product','module'=>'product']);

        Permission::create(['name' => 'add category','module'=>'category']);
        Permission::create(['name' => 'edit category','module'=>'category']);
        Permission::create(['name' => 'delete category','module'=>'category']);
        Permission::create(['name' => 'view category','module'=>'category']);

        Permission::create(['name' => 'add role','module'=>'role']);
        Permission::create(['name' => 'edit role','module'=>'role']);
        Permission::create(['name' => 'delete role','module'=>'role']);
        Permission::create(['name' => 'view role','module'=>'role']);
    }
}
