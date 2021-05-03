<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\Country;

class CountrySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $country = Country::insert([
            [
                'id' => 1,
                'name' => 'Egypt',
            ],[
                'id' => 2,
                'name' => 'Turkey',
            ],[
                'id' => 3,
                'name' => 'France',
            ],[
                'id' => 4,
                'name' => 'USA',
            ],[
                'id' => 5,
                'name' => 'UK',
            ],[
                'id' => 6,
                'name' => 'Saudi Arabia',
            ],[
                'id' => 7,
                'name' => 'Qatar',
            ],[
                'id' => 8,
                'name' => 'Algeria',
            ],

        ]);   
    }
}
