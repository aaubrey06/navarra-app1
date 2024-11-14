<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class InventoryTransactionTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $transaction_types = [
            'inbound',
            'outbound',
        ];

    }
}
