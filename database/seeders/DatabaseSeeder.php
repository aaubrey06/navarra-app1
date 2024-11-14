<?php

namespace Database\Seeders;

use App\Models\User;
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

        User::factory()->create([
            'first_name' => 'Driver',
            'last_name' => 'Driver',
            'email' => 'driver@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'driver',
        ]);

        User::factory()->create([
            'first_name' => 'Customer',
            'last_name' => 'Customer',
            'email' => 'customer@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'customer',
        ]);

        User::factory()->create([
            'first_name' => 'Store',
            'last_name' => 'Manager',
            'email' => 'storem@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'store_manager',
        ]);

        User::factory()->create([
            'first_name' => 'Warehouse',
            'last_name' => 'Manager',
            'email' => 'warehousem@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'warehouse_manager',
        ]);
        User::factory()->create([
            'first_name' => 'Owner',
            'last_name' => 'Owner',
            'email' => 'owner@gmail.com',
            'password' => bcrypt('12345678'),
            'role' => 'owner',
        ]);

        $this->call([
            MethodSeeder::class,
            StatusSeeder::class,
            CustomerSeeder::class,
            OrdersSeeder::class,
            StatusSeeder::class,
            InventoryTransactionTypeSeeder::class,
            WarehouseSeeder::class,
        ]);
    }
}
