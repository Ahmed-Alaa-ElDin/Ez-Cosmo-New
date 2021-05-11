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
        $ahmed = User::create([
            'first_name' => 'Ahmed',
            'last_name' => 'Alaa',
            'phone' => '01111339306',
            'password' => Hash::make('123456789'),
            'last_visit' => now(),
            'country_id' => '1',
            'email' => 'ahmedalaaaldin100@gmail.com',
        ]);

        $superAdmin = User::create([
            'first_name' => 'Super Admin',
            'last_name' => '',
            'phone' => '',
            'password' => Hash::make('123456789'),
            'last_visit' => now(),
            'country_id' => '1',
            'email' => 'superadmin@ez.com',
        ]);

        $admin = User::create([
            'first_name' => 'Admin',
            'last_name' => '',
            'phone' => '',
            'password' => Hash::make('123456789'),
            'last_visit' => now(),
            'country_id' => '1',
            'email' => 'admin@ez.com',
        ]);

        $subAdmin = User::create([
            'first_name' => 'Sub Admin',
            'last_name' => '',
            'phone' => '',
            'password' => Hash::make('123456789'),
            'last_visit' => now(),
            'country_id' => '1',
            'email' => 'subadmin@ez.com',
        ]);

        $superUser = User::create([
            'first_name' => 'Super User',
            'last_name' => '',
            'phone' => '',
            'password' => Hash::make('123456789'),
            'last_visit' => now(),
            'country_id' => '1',
            'email' => 'superuser@ez.com',
        ]);

        $user = User::create([
            'first_name' => 'User',
            'last_name' => '',
            'phone' => '',
            'password' => Hash::make('123456789'),
            'last_visit' => now(),
            'country_id' => '1',
            'email' => 'user@ez.com',
        ]);

        $ahmed->assignRole('Super Admin');

        $superAdmin->assignRole('Super Admin');

        $admin->assignRole('Admin');

        $subAdmin->assignRole('Sub Admin');

        $superUser->assignRole('Super User');

        $user->assignRole('User');

    }
}
