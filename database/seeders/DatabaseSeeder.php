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
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(PermissionsTableSeeder::class);
        $this->call(RolesTableSeeder::class);
        $this->call(CountrySeeder::class);
        $this->call(UserSeeder::class);
        $this->call(BrandSeeder::class);
        $this->call(LineSeeder::class);
        $this->call(FormSeeder::class);
        $this->call(IngredientSeeder::class);
        $this->call(IndicationSeeder::class);
        $this->call(CategorySeeder::class);
    }
}
