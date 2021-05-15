<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Indication;

class IndicationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Indication::insert([
            [
                'name' => 'Eczema'
            ],
            [
                'name' => 'Psoriasis'
            ],
            [
                'name' => 'Acne'
            ],
            [
                'name' => 'Rosacea'
            ],
            [
                'name' => 'Ichthyosis'
            ],
            [
                'name' => 'Vitiligo'
            ],
            [
                'name' => 'Hives'
            ],
            [
                'name' => 'Seborrheic Dermatitis'
            ]
        ]);
    }
}
