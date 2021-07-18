<?php

namespace Database\Seeders;

use App\Models\Sugar;
use Illuminate\Database\Seeder;

class SugarSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $sugars = ["Standard Sugar","Less Sugar", "More Sugar", "None Sugar"];

        foreach ($sugars as $sugar){
            $i = new Sugar();
            $i->name = $sugar;
            $i->save();
        }
    }
}
