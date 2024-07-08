<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class TagTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('tags')->insert([
            [
                'title' => 'Vegetarian',
                'description' => 'No meat or animal products',
                'kitchen_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Gluten-Free',
                'description' => 'No gluten or wheat products',
                'kitchen_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Spicy',
                'description' => 'Contains hot spices',
                'kitchen_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
