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
            'Bonehau',
            'Kalukku',
            'Kalumpang',
            'Kepulauan Balabalakang',
            'Mamuju',
            'Papalang',
            'Sampaga',
            'Simboro dan Kepulauan',
            'Tapalang',
            'Tapalang Barat',
            'Tommo'
        ]);

        $kuas->each(function($kua){
            Kua::create([
                'name' => $kua,
                'created_by' => User::first()->id,
            ]);
        });
    }
}
