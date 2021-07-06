<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;
use function GuzzleHttp\Promise\all;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = Role::where('name','Admin')->first();

        $user = new User();
        $user->id = Str::uuid();
        $user->name = "admin";
        $user->email = "admin@admin.com";
        $user->password = Hash::make("admin");
        $user->gender = "Male";
        $user->address = "JL. Anggrek";
        $user->role_id = $roles->id;
        $user->save();
    }
}
