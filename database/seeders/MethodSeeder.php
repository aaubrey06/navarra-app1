<?php

namespace Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

class MethodSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $methods = ['delivered', 'pickup'];

        foreach ($methods as $method) {

            DB::table('orders')->insert([
                'order_date' => now(),
                'customer_id' => 1,
                'rice_type' => 'Basmati',
                'quantity' => 10,
                'method' => $method,
                'status' => 'pending',

            ]);
        }
    }
}
