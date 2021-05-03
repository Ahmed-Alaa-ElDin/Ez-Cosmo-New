<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Brand;

class BrandSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Brand::insert([
            [
                'name' => 'Avene',
                'country_id' => 3
            ],
            [
                'name' => 'Bioderma',
                'country_id' => 3
            ],
            [
                'name' => 'Cleo',
                'country_id' => 1
            ],
            [
                'name' => 'SVR',
                'country_id' => 3
            ],
            [
                'name' => 'Vichy',
                'country_id' => 3
            ],
            [
                'name' => 'La Roche-Posay',
                'country_id' => 3
            ],
            [
                'name' => 'Nuxe',
                'country_id' => 3
            ],
            [
                'name' => 'Loreal',
                'country_id' => 3
            ],
            [
                'name' => 'Bourjois',
                'country_id' => 3
            ],
            [
                'name' => 'Uriage',
                'country_id' => 3
            ],
            [
                'name' => 'Garnier',
                'country_id' => 3
            ]
        ]
    );
    }
}
