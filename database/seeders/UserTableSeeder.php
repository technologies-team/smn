<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Schema;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Schema::disableForeignKeyConstraints();
        DB::table('users')->truncate();
        Schema::enableForeignKeyConstraints();

        User::create(
            [
            'name' => 'Admin',
            'email' => 'admin@smnfood.ae',
            'password' => 'password',
            'status' => 'ACTIVE',
            'role'=>'admin'
        ],

        );
        DB::table('users')->insert([
            [
                'name' => 'John Doe',
                'email' => 'john@example.com',
                'phone' => '1234567890',
                'rewards' => 100,
                'status' => 'ACTIVE',
                'photo_id' => 1,
                'role' => 'admin',
                'oauth_uid' => null,
                'email_verified_at' => now(),
                'verified' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Jane Smith',
                'email' => 'jane@example.com',
                'phone' => '0987654321',
                'rewards' => 200,
                'status' => 'NEW',
                'photo_id' => 2,
                'role' => 'kitchen',
                'oauth_uid' => null,
                'email_verified_at' => null,
                'verified' => false,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now()
            ],
            [
                'name' => 'Alice Johnson',
                'email' => 'alice@example.com',
                'phone' => '1122334455',
                'rewards' => 150,
                'status' => 'ACTIVE',
                'photo_id' => 3,
                'role' => 'customer',
                'oauth_uid' => null,
                'email_verified_at' => now(),
                'verified' => true,
                'password' => Hash::make('password123'),
                'created_at' => now(),
                'updated_at' => now()
            ]
        ]);
    }
}
