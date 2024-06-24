<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

class AttachmentsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('attachments')->truncate();
        Schema::enableForeignKeyConstraints();

        DB::table('attachments')->insert([
            [
                'name' => 'summer_sale.jpg',
                'mime_type' => 'image/jpeg',
                'path' => 'uploads/summer_sale.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'winter_collection.jpg',
                'mime_type' => 'image/jpeg',
                'path' => 'uploads/winter_collection.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'new_arrivals.jpg',
                'mime_type' => 'image/jpeg',
                'path' => 'uploads/new_arrivals.jpg',
                'created_at' => now(),
                'updated_at' => now()
            ],
        ]);
    }
}
