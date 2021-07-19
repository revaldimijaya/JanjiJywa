<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [["role" => "Admin"], ["role" => "Customer"], ["role" => "CEO"]];

        foreach ($roles as $role){

            $r = new Role();
            $r->id = Str::uuid();
            $r->name = $role["role"];

            $r->save();
        }
    }
}
