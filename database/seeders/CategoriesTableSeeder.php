<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class CategoriesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('categories')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('categories')->insert([
            [
                'title' => 'Main Course',
                'title_ar' => 'الطبق الرئيسي',
                'photo_id' => 1,
                'photo_ar_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Fast Food',
                'title_ar' => 'الوجبات السريعة',
                'photo_id' => 3,
                'photo_ar_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'title' => 'Salads',
                'title_ar' => 'سلطات',
                'photo_id' => 3,
                'photo_ar_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
