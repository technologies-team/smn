<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class NotificationsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        DB::table('notifications')->insert([
            'id' => Str::uuid()->toString(),
            'type' => 'App\Notifications\UserRegisteredNotification',
            'data' => json_encode([
                'message' => 'Welcome! Your registration was successful.',
                'user_id' => 1,
                'details' => 'Thank you for registering with us. We are excited to have you on board!'
            ]),
            'read_at' => null,
            'notifiable_id' => 1,
            'notifiable_type' => 'App\Models\User',
            'created_at' => now(),
            'updated_at' => now(),
        ]);
    }
}
