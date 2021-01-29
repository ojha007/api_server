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

        Permission::firstOrCreate(['name' => 'task-view', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'task-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'task-edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'task-delete', 'guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'worker-view', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'worker-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'worker-edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'worker-delete', 'guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'campaign-view', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'campaign-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'campaign-edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'campaign-delete', 'guard_name' => 'web']);

        Permission::firstOrCreate(['name' => 'booking-view', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'booking-create', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'booking-edit', 'guard_name' => 'web']);
        Permission::firstOrCreate(['name' => 'booking-delete', 'guard_name' => 'web']);


        // create roles and assign created permissions
        $role = Role::firstOrCreate(['name' => 'Administrator', 'guard_name' => 'web']);
        $permissions = Permission::where('guard_name', 'web')->get();
        $role->syncPermissions($permissions);
    }
}
