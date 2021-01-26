<?php


namespace Database\Seeders;


use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StateSeeder extends Seeder
{
    public function run()
    {
        $states = [
            "Australian Capital Territory",
            "New South Wales",
            "Northern Territory",
            "Queensland",
            "South Australia",
            "Tasmania",
            "Victoria",
            "Western Australia",
        ];
        $aus = DB::table('countries')
            ->where('name', '=', 'Australia')
            ->first();
        if ($aus)
            foreach ($states as $key => $state) {
                DB::table('states')
                    ->updateOrInsert(
                        [
                            'name' => $state,
                            "country_id" => $aus->id
                        ],
                        [
                            'name' => $state,
                            "country_id" => $aus->id
                        ],
                    );
            }
    }
}
