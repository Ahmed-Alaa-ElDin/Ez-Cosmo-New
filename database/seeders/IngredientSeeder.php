<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Ingredient;


class IngredientSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Ingredient::insert([
            [
                'name' => 'Ascorbic Acid'
            ],
            [
                'name' => 'Hyaluronic Acid'
            ],
            [
                'name' => 'Panthenol'
            ],
            [
                'name' => 'Retinol'
            ],
            [
                'name' => 'Citric Acid'
            ],
            [
                'name' => 'Tretinoin'
            ],
            [
                'name' => 'Lactic Acid'
            ],
            [
                'name' => 'Hydrolyzed Hyaluronic Acid'
            ],
            [
                'name' => 'Sodium Hyaluronate'
            ],
            [
                'name' => 'Salicylic Acid'
            ],
            [
                'name' => 'Linolenic Acid'
            ]
        ]);
    }
}
