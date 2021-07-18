<?php

namespace Database\Seeders;

use App\Models\Ice;
use Illuminate\Database\Seeder;

class IceSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $ices = ["Standard Ice","Less Ice", "More Ice", "None Ice"];

        foreach ($ices as $ice){
            $i = new Ice();
            $i->name = $ice;
            $i->save();
        }


    }
}
