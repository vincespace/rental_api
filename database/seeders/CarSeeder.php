<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class CarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        $cars = [
            [
                'brand' => 'Volvo',
                'model' => 'XC60',
                'engine' => '2.0L',
                'price_per_day' => 4000,
                'image' => '/images/cars/Volvo_XC60.jpg',
                'quantity' => 1,
                'status' => 'Available',

                'reduce' => 20,
                'stars' => 5,
            ],
            [
                'brand' => 'Mitsubishi',
                'model' => 'Outlander',
                'engine' => '2.4L',
                'price_per_day' => 4500.00,
                'image' => '/images/cars/Mitsubishi_Outlander.jpg',
                'quantity' => 1,
                'status' => 'Available',

                'reduce' => 30,
                'stars' => 5,
            ],
            [
                'brand' => 'GMC',
                'model' => 'Sierra_1500',
                'engine' => '5.3L V8',
                'price_per_day' => 2500.00,
                'image' => '/images/cars/GMC_Sierra_1500.jpg',
                'quantity' => 1,
                'status' => 'Available',

                'reduce' => 35,
                'stars' => 4,
            ],
            [
                'brand' => 'Fiat',
                'model' => '500',
                'engine' => '1.4L',
                'price_per_day' => 4000.00,
                'image' => '/images/cars/Fiat_500.jpg',
                'quantity' => 1,
                'status' => 'Available',

                'reduce' => 40,
                'stars' => 5,
            ],
            [
                'brand' => 'Mini',
                'model' => 'Cooper',
                'engine' => '1.5L',
                'price_per_day' => 5500.00,
                'image' => '/images/cars/Mini_Cooper.jpg',
                'quantity' => 1,
                'status' => 'Available',
                'reduce' => 30,
                'stars' => 5,
            ],
            [
                'brand' => 'Audi',
                'model' => 'Q5',
                'engine' => '2.0L',
                'price_per_day' => 3500.00,
                'image' => '/images/cars/Audi_Q5.jpg',
                'quantity' => 1,
                'status' => 'Available',

                'reduce' => 40,
                'stars' => 5,
            ], [
                'brand' => 'Chevrolet',
                'model' => 'Tahoe',
                'engine' => '5.3L V8',
                'price_per_day' => 3000.00,
                'image' => '/images/cars/Chevrolet_Tahoe.jpg',
                'quantity' => 1,
                'status' => 'Available',

                'reduce' => 20,
                'stars' => 5,
            ],
        ];

        foreach ($cars as $car) {
            DB::table('cars')->insert([
                'brand' => $car['brand'],
                'model' => $car['model'],
                'engine' => $car['engine'],
                'price_per_day' => $car['price_per_day'],
                'image' => $car['image'],
                'quantity' => $car['quantity'],
                'status' => $car['status'],
                'reduce' => $car['reduce'],
                'stars' => $car['stars'],
            ]);
        }
    }
}
