<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\InventoryTransactionType;

class InventoryTransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $types = [
            ['inventoryt_type' => 'Inbound'],
            ['inventoryt_type' => 'Outbound'],
           
        ];

        InventoryTransactionType::insert($types);
    }
}
