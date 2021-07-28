<?php

namespace Database\Seeders;

use App\Models\Role;
use Illuminate\Database\Seeder;

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
    }
}
