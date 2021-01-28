<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 12/19/2018
 * Time: 5:21 PM
 */

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeeder extends Seeder
{

    public function run()
    {
        app()[\Spatie\Permission\PermissionRegistrar::class]->forgetCachedPermissions();
        Permission::firstOrCreate(['name' => 'backend-permission']);
        $role = Role::firstOrCreate(['name' => 'Administrator', 'guard_name' => 'web']);
        $permissions = Permission::where('guard_name', 'web')->get();
        $role->syncPermissions($permissions);
    }
}
