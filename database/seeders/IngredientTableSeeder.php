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
        DB::table('options')->insert([
            [
                'name' => 'Sugar',
                'type' => 'single',
                'price'=>0,
                'mandatory' => true,
                'parent_id' => null,
                'food_id' => 1,

            ],
            [
                'name' => 'with sugar',
                'type' => "ingredient",
                'price'=>0,
                'mandatory' => false,
                'parent_id' => 1,
                'food_id' => null,

            ],
            [
                'name' => 'without sugar',
                'type' => 'ingredient',
                'price'=>0,
                'mandatory' => true,
                'parent_id' => 1,
                'food_id' => 2,
            ],
            [
            'name' => 'cheese',
            'type' => 'additional',
            'price'=>0,
            'mandatory' => true,
            'parent_id' => null,
            'food_id' => 1,

        ],
            [
                'name' => 'Akkawi',
                'type' => "multi",
                'price'=>5,
                'mandatory' => false,
                'parent_id' => 4,
                'food_id' => null,

            ],
            [
                'name' => 'mozzarella',
                'type' => 'multi',
                'price'=>2.5,
                'mandatory' => true,
                'parent_id' => 4,
                'food_id' => null,
            ]
        ]);
    }
}
