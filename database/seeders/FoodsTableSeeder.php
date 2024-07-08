<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class FoodsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('foods')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('foods')->insert([
            [
                'title' => 'Pasta',
                'title_ar' => 'باستا',
                'description' => 'Delicious pasta with tomato sauce',
                'description_ar' => 'باستا لذيذة مع صلصة الطماطم',
                'weight' => 250.00,
                'deliverable' => true,
                'unit' => 'grams',
                'preparation_time' => '00:30:00',
                'ingredients' => json_encode(['pasta', 'tomato sauce', 'cheese']),
                'price' => 15.00,
                'kitchen_id' => 1,
                'category_id' => 1,
                'tag_id' => 1,
                'rewards' => 10,
                'photo_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Burger',
                'title_ar' => 'برجر',
                'description' => 'Juicy beef burger with cheese',
                'description_ar' => 'برجر لحم عصير مع الجبن',
                'weight' => 300.00,
                'deliverable' => true,
                'unit' => 'grams',
                'preparation_time' => '00:20:00',
                'ingredients' => json_encode(['beef patty', 'cheese', 'bun']),
                'price' => 10.00,
                'kitchen_id' => 1,
                'category_id' => 2,
                'tag_id' => 2,

                'rewards' => 8,
                'photo_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Salad',
                'title_ar' => 'سلطة',
                'description' => 'Fresh garden salad',
                'description_ar' => 'سلطة حديقة طازجة',
                'weight' => 150.00,
                'deliverable' => false,
                'unit' => 'grams',
                'preparation_time' => '00:10:00',
                'ingredients' => json_encode(['lettuce', 'tomatoes', 'cucumbers']),
                'price' => 7.00,
                'kitchen_id' => 2,
                'category_id' => 3,
                'tag_id' => 3,

                'rewards' => 5,
                'photo_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
