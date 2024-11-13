<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Customer;
use App\Models\User; 
use Faker\Factory as Faker;

class CustomerSeeder extends Seeder
{
    public function run()
    {
        $faker = Faker::create();

      
        $customer = Customer::first(); 

       
        for ($i = 0; $i < 10; $i++) {
            Customer::create([
                'customer_id'   => $customer->customer_id,  
                'region'    => $faker->state,
                'province'  => $faker->city,
                'city'      => $faker->city,
                'barangay'  => $faker->word,
                'address'   => $faker->address,
                'latitude'  => $faker->latitude,
                'longitude' => $faker->longitude,
            ]);
        }
    }
}
