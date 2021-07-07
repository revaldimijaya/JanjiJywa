<?php

namespace Database\Seeders;

use App\Models\BeverageType;
use Illuminate\Database\Seeder;
use Illuminate\Support\Str;

class BeverageTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $types = ['Boba', 'Tea', 'Coffee', 'Mocktail', 'Juice'];

        foreach ($types as $type){
            $t = new BeverageType();
            $t->id = Str::uuid();
            $t->name = $type;
            $t->save();
        }
    }
}
