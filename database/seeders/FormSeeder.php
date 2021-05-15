<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Form;

class FormSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Form::insert([
            [
                'name' => 'Cream'
            ],
            [
                'name' => 'Gel'
            ],
            [
                'name' => 'Ointment'
            ],
            [
                'name' => 'Spray'
            ],
            [
                'name' => 'Lotion'
            ]
        ]);
    }
}
