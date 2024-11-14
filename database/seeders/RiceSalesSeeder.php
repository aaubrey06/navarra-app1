<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Data; 

class RiceSalesSeeder extends Seeder
{
    public function run()
    {
        $data = [
            ['sales_date' => '2023-07-21', 'rice_type' => 'Angela', 'unit' => 'kg', 'quantity_sold' =>308],
            ['sales_date' => '2023-07-21', 'rice_type' => 'Aroma', 'unit' => 'kg', 'quantity_sold' => 243],
            ['sales_date' => '2023-07-21', 'rice_type' => 'Bea', 'unit' => 'kg', 'quantity_sold' => 33],
            ['sales_date' => '2023-07-21', 'rice_type' => 'Cherry', 'unit' => 'kg', 'quantity_sold' => 345],

        ];

        Data::insert($data);
    }
}
