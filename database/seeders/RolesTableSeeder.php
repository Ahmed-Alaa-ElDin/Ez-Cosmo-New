<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $supAdmin = Role::create([
            'name' => 'super_admin',
            'display_name' => 'Super Admin', // optional
            'description' => 'User can make all CRUD', // optional
        ]);
        
        $admin = Role::create([
            'name' => 'admin',
            'display_name' => 'Administrator', // optional
            'description' => 'User is allowed to manage and edit other users and products', // optional
        ]);

        $subAdmin = Role::create([
            'name' => 'sub_admin',
            'display_name' => 'User Administrator', // optional
            'description' => 'User is allowed to manage and edit other users only', // optional
        ]);

        $VIPUser = Role::create([
            'name' => 'vip_user',
            'display_name' => 'VIP User', // optional
            'description' => 'User is allowed to add new product', // optional
        ]);

        $user = Role::create([
            'name' => 'user',
            'display_name' => 'User', // optional
            'description' => 'User is allowed view products', // optional
        ]);
    }
}
