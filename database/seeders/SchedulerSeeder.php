<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class SchedulerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        \App\Models\Schedule::create([
            'order_number' => '0079',
            'customer_name' => 'Sweet Joy Kween',
            'location' => 'San Juan, Molo, Iloilo City',
            'contact_number' => '+639090909099',
        ]);
        \App\Models\Schedule::create([
            'order_number' => '0079',
            'customer_name' => 'Sweet Joy Kween',
            'location' => 'Luna St. La Paz, Iloilo City',
            'contact_number' => '+639090909099',
        ]);
        \App\Models\Schedule::create([
            'order_number' => '0079',
            'customer_name' => 'Sweet Joy Kween',
            'location' => 'Sambag, Jaro, Iloilo City',
            'contact_number' => '+639090909099',
        ]);
    }
}
