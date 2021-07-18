<?php

namespace Database\Seeders;

use App\Models\Beverage;
use App\Models\BeverageType;
use App\Models\Ice;
use App\Models\Sugar;
use App\Models\Topping;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeverageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = BeverageType::all();

        $types = [
            'Boba' => $types->where('name', 'Boba')->first()->id,
            'Tea' => $types->where('name', 'Tea')->first()->id,
            'Coffee'=> $types->where('name', 'Coffee')->first()->id,
            'Mocktail'=> $types->where('name', 'Mocktail')->first()->id,
            'Juice'=> $types->where('name', 'Juice')->first()->id,
        ];

        $ices = Ice::all();

        $ices = [
            'Standard Ice' => $ices->where('name', 'Standard Ice'),
            'Less Ice'  => $ices->where('name', 'Less Ice'),
            'More Ice' => $ices->where('name', 'More Ice'),
            'None Ice'  => $ices->where('name', 'None Ice'),
        ];

        $sugars = Sugar::all();

        $sugars = [
            'Standard Sugar' => $sugars->where('name', 'Standard Sugar'),
            'Less Sugar'  => $sugars->where('name', 'Less Sugar'),
            'More Sugar' => $sugars->where('name', 'More Sugar'),
            'None Sugar'  => $sugars->where('name', 'None Sugar'),
        ];

        $toppings = Topping::all();

        $toppings = [
            'Bubble' => $toppings->where('name', 'Bubble'),
            'Grass Jelly'  => $toppings->where('name', 'Grass Jelly'),
            'Regal' => $toppings->where('name', 'Regal'),
            'Ice Cream Vanilla'  => $toppings->where('name', 'Ice Cream Vanilla'),
            'Ice Cream Choco'=> $toppings->where('name', 'Ice Cream Choco'),
            'Ice Cream Matcha'=> $toppings->where('name', 'Ice Cream Matcha'),
        ];

        $beverages = [
            [
                'id' => Str::uuid(),
                'beverage_type_id' => $types["Coffee"],
                'name' => "Kopi Soklat",
                'price' => 20000,
                'stock' => 20,
                'image' => "1626158741cede9cd939b24290939fcfea17ba539f_1623418483206349449.jpg",
                'description' => "Coffee with premium chocolate",
                'custom_topping' => 'false',
                'custom_ice' => 'true',
                'custom_sugar' => 'true'
            ],
            [
                'id' => Str::uuid(),
                'beverage_type_id' => $types["Boba"],
                'name' => "Brown Sugar Milk Tea",
                'price' => 25000,
                'stock' => 20,
                'image' => "1626158741cede9cd939b24290939fcfea17ba539f_1623418483206349449.jpg",
                'description' => "Boba with premium chocolate",
                'custom_topping' => 'true',
                'custom_ice' => 'true',
                'custom_sugar' => 'true'
            ],
            [
                'id' => Str::uuid(),
                'beverage_type_id' => $types["Tea"],
                'name' => "Thaitea",
                'price' => 15000,
                'stock' => 20,
                'image' => "1626158741cede9cd939b24290939fcfea17ba539f_1623418483206349449.jpg",
                'description' => "Tea with premium chocolate",
                'custom_topping' => 'false',
                'custom_ice' => 'true',
                'custom_sugar' => 'true'
            ]

        ];

        foreach ($beverages as $beverage){
            $b = new Beverage();
            $b->id = $beverage["id"];
            $b->beverage_type_id = $beverage["beverage_type_id"];
            $b->name = $beverage["name"];
            $b->price = $beverage["price"];
            $b->stock = $beverage["stock"];
            $b->image = $beverage["image"];
            $b->description = $beverage["description"];
            $b->custom_topping = $beverage["custom_topping"];
            $b->custom_ice = $beverage["custom_ice"];
            $b->custom_sugar = $beverage["custom_sugar"];
            $b->save();
        }
    }
}
