<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;

class StatusSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        DB::table('order_status')->insert([
            ['order_status_id' => 1, 'status' => 'Pending'],
            ['order_status_id' => 2, 'status' => 'Shipped'],
            ['order_status_id' => 3, 'status' => 'Delivered']
        ]);
    }
    
}
