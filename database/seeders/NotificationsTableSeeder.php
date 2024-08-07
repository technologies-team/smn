<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example of creating multiple notifications
        DB::table('notifications')->insert([
            [
                'type' => 'App\\Notifications\\UserRegisteredNotification', // Adjust based on your actual notification class
                'notifiable_id' => 1, // Assuming a user with ID 1 is the one who registered
                'notifiable_type' => 'App\\Models\\User', // Adjust based on your actual notifiable model
                'data' => json_encode([
                    'message' => 'Welcome! Your registration was successful.',
                    'user_id' => 1,
                    'details' => 'Thank you for registering with us. We are excited to have you on board!'
                ]),
                'read_at' => null, 
                'created_at' => Carbon::now(),
                'updated_at' => Carbon::now(),
            ]
        ]);
    }
}
