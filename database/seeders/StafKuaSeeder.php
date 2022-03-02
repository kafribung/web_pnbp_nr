<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StafKuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $akuns = [
            // Tipologi C
            ['name' => 'KUA Tapalang', 'email' => 'tapalang@tapalang.com', 'email_verified_at' => now(), 'password' => bcrypt('password'), 'kua_id' => 1],
            ['name' => 'KUA Simboro dan Kepulauan', 'email' => 'simboro@simboro.com', 'email_verified_at' => now(), 'password' => bcrypt('password'), 'kua_id' => 2],
            ['name' => 'KUA Mamuju', 'email' => 'mamuju@mamuju.com', 'email_verified_at' => now(), 'password' => bcrypt('password'), 'kua_id' => 3],
            ['name' => 'KUA Kalukku', 'email' => 'kalukku@kalukku.com', 'email_verified_at' => now(), 'password' => bcrypt('password'), 'kua_id' => 4],
            ['name' => 'KUA Papalang', 'email' => 'papalang@papalang.com', 'email_verified_at' => now(), 'password' => bcrypt('password'), 'kua_id' => 5],
            ['name' => 'KUA Sampaga', 'email' => 'sampaga@sampaga.com', 'email_verified_at' => now(), 'password' => bcrypt('password'), 'kua_id' => 6],

            // Tipologi D1
            ['name' => 'KUA Tapalang Barat', 'email' => 'tapalang_barat@tapalang_barat.com', 'email_verified_at' => now(), 'password' => bcrypt('password'), 'kua_id' => 7],
            ['name' => 'KUA Bonehau', 'email' => 'bonehau@bonehau.com', 'email_verified_at' => now(), 'password' => bcrypt('password'), 'kua_id' => 8],
            ['name' => 'KUA Kalumpang', 'email' => 'kalumpang@kalumpang.com', 'email_verified_at' => now(), 'password' => bcrypt('password'), 'kua_id' => 9],
            ['name' => 'KUA Tommo', 'email' => 'tommo@tommo.com', 'email_verified_at' => now(), 'password' => bcrypt('password'), 'kua_id' => 10],

            // Tipologi D2
            ['name' => 'KUA Kepulauan Balabalakang', 'email' => 'balabalakang@balabalakang.com', 'email_verified_at' => now(), 'password' => bcrypt('password'), 'kua_id' => 11],
        ];

        foreach ($akuns as $index => $akun) {
            User::create($akun);

            DB::table('role_user')->insert([
                'user_id' => $index+2,
                'role_id' => 2,
            ]);
        }
    }
}
