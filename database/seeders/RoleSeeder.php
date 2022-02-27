<?php

namespace Database\Seeders;

use App\Models\Role;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            'admin',
            'staf',
        ];

        foreach ($roles as $key => $roles) {
            Role::create([
                'name' => $roles,
            ]);
        }

        DB::table('role_user')->insert([
            'user_id' => User::first()->id,
            'role_id' => 1,
        ]);
    }
}
