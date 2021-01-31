<?php

use Illuminate\Database\Seeder;
use App\Product;
use App\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            UserSeeder::class,
            ProductSeeder::class
        ]);
    }
}
