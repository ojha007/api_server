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
        User::updateOrCreate(
            ['email' => 'admin@gmail.com'],
            ['name' => 'Admin',
                'password' => bcrypt('123456'),
            ]);

    }
}
