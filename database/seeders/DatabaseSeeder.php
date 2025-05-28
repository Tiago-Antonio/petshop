<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // User::factory(10)->create();

        // User::factory()->create([
        //     'name' => 'Test User',
        //     'email' => 'test@example.com',
        // ]);

        $this->call(UsersSeeder::class);
        $this->call(ClientsSeeder::class);
        $this->call(SuppliersSeeder::class);
        $this->call(ProductsSeeder::class);
        $this->call(PaymentsSeeder::class);
        $this->call(StockEntriesSeeder::class);
        $this->call(OrderSeeder::class);
    }
}
