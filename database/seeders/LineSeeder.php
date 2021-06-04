<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Line;

class LineSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Line::insert([
            [
                'name' => 'Cleanance',
                'brand_id' => 1
            ],
            [
                'name' => 'Cicalfate',
                'brand_id' => 1
            ],
            [
                'name' => 'Xeracalm',
                'brand_id' => 1
            ],
            [
                'name' => 'Trixera',
                'brand_id' => 1
            ],
            [
                'name' => 'Physiolift',
                'brand_id' => 1
            ],
            [
                'name' => 'Triacneal',
                'brand_id' => 1
            ],
            [
                'name' => 'Photoderm',
                'brand_id' => 2
            ],
            [
                'name' => 'Atoderm',
                'brand_id' => 2
            ],
            [
                'name' => 'Hydrabio',
                'brand_id' => 2
            ],
            [
                'name' => 'White Objective',
                'brand_id' => 2
            ],
            [
                'name' => 'Sensibio',
                'brand_id' => 2
            ],
            [
                'name' => 'Sébium',
                'brand_id' => 2
            ],
            [
                'name' => 'Rich',
                'brand_id' => 3
            ],
            [
                'name' => 'Lightening',
                'brand_id' => 3
            ],
            [
                'name' => 'Cicavit',
                'brand_id' => 4
            ],
            [
                'name' => 'Sebiaclear',
                'brand_id' => 4
            ],
            [
                'name' => 'Xérial',
                'brand_id' => 4
            ],
            [
                'name' => 'Mineral 89',
                'brand_id' => 5
            ],
            [
                'name' => 'Thermal SPA Water',
                'brand_id' => 5
            ],
            [
                'name' => 'Normaderm',
                'brand_id' => 5
            ],
            [
                'name' => 'Lifactiv',
                'brand_id' => 5
            ],
            [
                'name' => 'Ideal Soleil',
                'brand_id' => 5
            ],
            [
                'name' => 'Purete Thermale',
                'brand_id' => 5
            ],
            [
                'name' => 'Deodorant',
                'brand_id' => 5
            ],
            [
                'name' => 'Dercos Technique',
                'brand_id' => 5
            ],
            [
                'name' => 'Lifeactiv Specialist',
                'brand_id' => 5
            ]
        ]
    );
    }
}
