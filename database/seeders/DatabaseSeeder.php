<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run(): void
    {
        $this->call([
            RolesAndPermissionsSeeder::class,
            RolesAndPermissionsSeederAms::class,
            UserSeeder::class,
        ]);
        // \App\Models\User::factory(10)->create();
    }
}
