<?php

namespace Database\Seeders;

use App\Models\Kua;
use App\Models\User;
use Illuminate\Database\Seeder;

class KuaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $kuas = collect([
            // Tipologi C
            ['name' => 'Tapalang', 'typology_id' => 3, 'created_by' => User::first()->id],
            ['name' => 'Simboro dan Kepulauan', 'typology_id' => 3, 'created_by' => User::first()->id],
            ['name' => 'Mamuju', 'typology_id' => 3, 'created_by' => User::first()->id],
            ['name' => 'Kalukku', 'typology_id' => 3, 'created_by' => User::first()->id],
            ['name' => 'Papalang', 'typology_id' => 3, 'created_by' => User::first()->id],
            ['name' => 'Sampaga', 'typology_id' => 3, 'created_by' => User::first()->id],

            // Tipologi D1
            ['name' => 'Tapalang Barat', 'typology_id' => 4, 'created_by' => User::first()->id],
            ['name' => 'Bonehau', 'typology_id' => 4, 'created_by' => User::first()->id],
            ['name' => 'Kalumpang', 'typology_id' => 4, 'created_by' => User::first()->id],
            ['name' => 'Tommo', 'typology_id' => 4, 'created_by' => User::first()->id],

            // Tipologi D2
            ['name' => 'Kepulauan Balabalakang', 'typology_id' => 5, 'created_by' => User::first()->id],

        ]);

        $kuas->each(function($kua){
            Kua::create($kua);
        });
    }
}
