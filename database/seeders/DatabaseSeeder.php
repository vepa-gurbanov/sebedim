<?php

namespace Database\Seeders;

use App\Models\Customer;
use App\Models\Product;
use App\Models\Review;
use App\Models\Store;
use App\Models\User;
use App\Models\Warehouse;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            RoleSeeder::class,
        ]);

        User::factory(10)->create();
        Customer::factory(100)->create();

        $this->call([
            BrandSeeder::class,
            CategorySeeder::class,
            LocationSeeder::class,
        ]);

        Warehouse::factory(10)->create();
        Store::factory(25)->create();
        Product::factory(5000)->create();
        Review::factory(500)->create();
    }
}
