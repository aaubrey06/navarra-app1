<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\WarehouseLocation;

class WarehouseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Data to be seeded into the warehouses table
        $warehouses = [
            [
                'warehouse_location' => 'Warehouse A',
                'warehouse_longitude' => '10.7187',
                'warehouse_latitude' => '-122.5789',
            ],
            [
                'warehouse_location' => 'Warehouse B',
                'warehouse_longitude' => '11.2345',
                'warehouse_latitude' => '-123.4567',
            ],
        ];

        // Insert data into the table
        foreach ($warehouses as $warehouse) {
            WarehouseLocation::create($warehouse);
        }
    }
}



