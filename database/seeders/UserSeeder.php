<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\DB;
use App\Models\User;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user = User::create([
            'first_name' => 'Ahmed',
            'last_name' => 'Alaa',
            'phone' => '01111339306',
            'password' => Hash::make('123456789'),
            'last_visit' => now(),
            'country_id' => '1',
            'role_id' => '1',
            'email' => 'ahmedalaaaldin100@gmail.com',
        ]);

        // $user->attachRole('super_admin');    
    }
}
