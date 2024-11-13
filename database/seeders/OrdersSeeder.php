<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use DB;
use Carbon\Carbon;
class OrdersSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
{
    // Ensure you only fetch the 'order_status_id' values if needed, no need for 'status' unless it exists and is necessary.
    $statuses = DB::table('order_status')->pluck('order_status_id');

    DB::table('orders')->insert([
        [
            'customer_id' => 1,
            'order_status_id' => 1, // Adjust ID based on available statuses
            'product_id' => 2,
            'order_date' => Carbon::now()->toDateString(),
            'rice_type' => 'Premium Rice',
            'quantity' => 10,
            'method' => 'pickup',
            'tracking_no' => 'ORD123456789',
            'delivery_date' => Carbon::now()->addDays(2)->toDateString(),
            'payment_status' => 'pending',
            'location' => '123 Main St, City Center',
            'latitude' => 14.5995,
            'longitude' => 120.9842,
        ],
        [
            'customer_id' => 2,
            'order_status_id' => 2, // Adjust ID based on available statuses
            'product_id' => 3,
            'order_date' => Carbon::now()->subDays(1)->toDateString(),
            'rice_type' => 'Brown Rice',
            'quantity' => 5,
            'method' => 'delivery',
            'tracking_no' => 'ORD987654321',
            'delivery_date' => Carbon::now()->addDays(3)->toDateString(),
            'payment_status' => 'paid',
            'location' => '456 Elm St, Downtown',
            'latitude' => 14.6260,
            'longitude' => 120.9931,
        ],
        [
            'customer_id' => 3,
            'order_status_id' => 3, // Adjust ID based on available statuses
            'product_id' => 1,
            'order_date' => Carbon::now()->subDays(3)->toDateString(),
            'rice_type' => 'Jasmine Rice',
            'quantity' => 20,
            'method' => 'delivery',
            'tracking_no' => 'ORD1122334455',
            'delivery_date' => Carbon::now()->subDays(1)->toDateString(),
            'payment_status' => 'paid',
            'location' => '789 Oak St, Greenfield',
            'latitude' => 14.7153,
            'longitude' => 121.0336,
        ],
        [
            'customer_id' => 4,
            'order_status_id' => 1, // Adjust ID based on available statuses
            'product_id' => 2,
            'order_date' => Carbon::now()->toDateString(),
            'rice_type' => 'Premium Rice',
            'quantity' => 30,
            'method' => 'pickup',
            'tracking_no' => 'ORD6677889900',
            'delivery_date' => Carbon::now()->addDays(1)->toDateString(),
            'payment_status' => 'pending',
            'location' => '101 Pine St, Uptown',
            'latitude' => 14.8237,
            'longitude' => 120.9825,
        ]
    ]);
}

}
