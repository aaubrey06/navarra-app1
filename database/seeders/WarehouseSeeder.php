<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Example warehouse data
        Warehouse::create([
            'warehouse_location' => 'Warehouse A',
            'warehouse_longitude' => '10.7187',  // Example longitude
            'warehouse_latitude' => '-122.5789', // Example latitude
        ]);
    }
}
