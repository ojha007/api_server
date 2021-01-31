<?php


namespace Database\Seeders;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    public function run()
    {
        Model::unguard();
        $superUser = User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin',
                'password' => bcrypt('123456'),
                'super' => true,
                'status' => true
            ]);
        $worker = User::updateOrCreate(
            ['email' => 'worker@gmail.com'],
            ['name' => 'Worker1',
                'password' => bcrypt('123456'),
                'super' => false,
                'status' => true
            ]);
        $user = User::updateOrCreate(
            ['email' => 'user@gmail.com'],
            ['name' => 'User1',
                'password' => bcrypt('123456'),
                'super' => false,
                'status' => true
            ]);
        if (!$superUser->hasRole('Administrator'))
            $superUser->assignRole('Administrator', 'web');

        if (!$superUser->hasPermissionTo('backend-permission'))
            $superUser->givePermissionTo('backend-permission');

        if (!$user->hasRole('Customer'))
            $user->assignRole('Customer', 'web');

        if (!$worker->hasRole('Worker'))
            $worker->assignRole('Worker', 'web');


    }
}
