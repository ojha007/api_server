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
        if (!$superUser->hasRole('Administrator'))
            $superUser->assignRole('Administrator', 'web');

        if (!$superUser->hasPermissionTo('backend-permission'))
            $superUser->givePermissionTo('backend-permission');

    }
}
