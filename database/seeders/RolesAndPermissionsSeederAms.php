<?php
/**
 * Created by PhpStorm.
 * User: acer
 * Date: 12/18/2018
 * Time: 11:45 AM
 */

namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RolesAndPermissionsSeederAms extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // Reset cached roles and permissions
        //app()['cache']->forget('spatie.permission.cache');

        // user permissions
        Permission::firstOrCreate(['name' => 'user-view', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'user-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'user-edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'user-delete', 'guard_name' => 'web']);
        // role permissions
        Permission::firstOrCreate(['name' => 'role-view', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'role-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'role-edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'role-delete', 'guard_name' => 'web']);


        // create roles and assign created permissions
        $role = Role::firstOrCreate(['name' => 'Administrator', 'guard_name' => 'web']);
        $permissions = Permission::where('guard_name', 'web')->get();
        $role->syncPermissions($permissions);
    }
}
