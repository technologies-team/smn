<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class IngredientTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('ingredients')->insert([
            [
                'name' => 'Sugar',
                'multi' => false,
                'mandatory' => true,
                'parent_id' => null,
                'food_id' => 1,

            ],
            [
                'name' => 'with sugar',
                'multi' => false,
                'mandatory' => false,
                'parent_id' => 1,
                'food_id' => null,

            ],
            [
                'name' => 'without sugar',
                'multi' => false,
                'mandatory' => true,
                'parent_id' => 1,
                'food_id' => 2,
            ]
        ]);
    }
}
