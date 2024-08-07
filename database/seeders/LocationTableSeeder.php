<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LocationTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        DB::table('locations')->insert([
            [
                'title' => 'Home',
                'street1' => '123 Main St',
                'country' => 'USA',
                'city' => 'New York',
                'latitude' => 40.7128,
                'longitude' => -74.0060,
                'phone' => '21234566',
                'verified' => true,
                'user_id' => 4,
                'created_at' => now(),
                'updated_at' => now(),
            ],
            [
                'title' => 'Work',
                'street1' => '456 Business Blvd',
                'country' => 'USA',
                'city' => 'Los Angeles',
                'phone' => '123456',
                'verified' => true,
                'latitude' => 34.0522,
                'longitude' => -118.2437,
                'user_id' => 2,
                'created_at' => now(),
                'updated_at' => now(),
            ],

        ]);

    }
}
