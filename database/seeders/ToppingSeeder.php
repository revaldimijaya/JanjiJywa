<?php

namespace Database\Seeders;

use App\Models\Topping;
use Illuminate\Database\Seeder;

class ToppingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $toppings = [
            [
                "name" => "Bubble",
                "price" => 5000
            ],
            [
                "name" =>"Grass Jelly",
                "price" => 5000
            ],
            [
                "name" => "Regal",
                "price" => 5000
            ],
            [
                "name" => "Ice Cream Vanilla",
                "price" => 10000
            ],
            [
                "name" => "Ice Cream Choco",
                "price" => 10000
            ],
            [
                "name" => "Ice Cream Matcha",
                "price" => 10000
            ]
        ];

        foreach ($toppings as $topping){
            $i = new Topping();
            $i->name = $topping["name"];
            $i->price = $topping["price"];
            $i->save();
        }
    }
}
