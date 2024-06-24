<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call(AttachmentsTableSeeder::class);
        $this->call(UserTableSeeder::class);
        $this->call( BannersTableSeeder::class);
        $this->call(KitchensTableSeeder::class,);
        $this->call([CategoriesTableSeeder::class]);
        $this->call([FoodsTableSeeder::class,]);

    }
}
