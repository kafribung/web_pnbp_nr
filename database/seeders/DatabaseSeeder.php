<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        \App\Models\User::factory()->create();
        $this->call([
            RoleSeeder::class,
            TypologySeeder::class,
            KuaSeeder::class,
            GolonganSeeder::class,
            PeristiwaNikahSeeder::class,
            DesaSeeder::class,
            StafKuaSeeder::class,
        ]);
    }
}
