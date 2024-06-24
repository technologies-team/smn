<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class BannersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        DB::table('banners')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('banners')->insert([
            [
                'photo_id' => 1,
                'description' => 'Summer Sale Banner',
                'title' => 'Summer Sale',
                'language' => 'en',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'photo_id' => 2,
                'description' => 'Winter Collection Banner',
                'title' => 'Winter Collection',
                'language' => 'en',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'photo_id' => 3,
                'description' => 'New Arrivals Banner',
                'title' => 'New Arrivals',
                'language' => 'en',
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
