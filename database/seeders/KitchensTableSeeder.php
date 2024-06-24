<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class KitchensTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {   Schema::disableForeignKeyConstraints();
        DB::table('kitchens')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('kitchens')->insert([
            [
                'user_id' => 3,
                'title' => 'Gourmet Kitchen',
                'title_ar' => 'مطبخ الذواقة',
                'description' => 'A high-end kitchen serving gourmet meals',
                'description_ar' => 'مطبخ عالي الجودة يقدم وجبات ذواقة',
                'phone' => 123456789,
                'mobile' => 987654321,
                'verified' => true,
                'ready_to_delivery' => true,
                'status' => 'open',
                'active' => true,
                'photo_id' => 1,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'title' => 'Fast Food Kitchen',
                'title_ar' => 'مطبخ الوجبات السريعة',
                'description' => 'Quick and delicious fast food',
                'description_ar' => 'وجبات سريعة لذيذة',
                'phone' => 223456789,
                'mobile' => 987654322,
                'verified' => false,
                'ready_to_delivery' => false,
                'status' => 'closed',
                'active' => false,
                'photo_id' => 2,
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'user_id' => 3,
                'title' => 'Healthy Kitchen',
                'title_ar' => 'مطبخ صحي',
                'description' => 'Nutritious and healthy meals',
                'description_ar' => 'وجبات مغذية وصحية',
                'phone' => 323456789,
                'mobile' => 987654323,
                'verified' => true,
                'ready_to_delivery' => true,
                'status' => 'busy',
                'active' => true,
                'photo_id' => 3,
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
