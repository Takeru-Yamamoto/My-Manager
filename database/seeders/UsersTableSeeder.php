<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use App\Consts\RoleConst;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach (RoleConst::ROLES as $role => $roleNum) {
            if (!empty(config("defaultUser." . $role . ".name")) && !empty(config("defaultUser." . $role . ".email")) && !empty(config("defaultUser." . $role . ".password"))) {
                User::create([
                    'name' => config("defaultUser." . $role . ".name"),
                    'email' => config("defaultUser." . $role . ".email"),
                    'password' => makeHash(config("defaultUser." . $role . ".password")),
                    'role' => $roleNum,
                    'is_valid' => 1
                ]);
            }
        }
    }
}
