<?php

namespace Database\Seeders;

use App\Models\Golongan;
use Illuminate\Database\Seeder;

class GolonganSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $clusters = [
            'Penghulu Pertama -  III/a',
            'Penghulu Pertama - III/b',
            'Penghulu Muda - III/c',
            'Penghulu Muda - III/d',
            'Penghulu Madya - IV/a',
            'Penghulu Madya - IV/b',
            'Penghulu Madya - IV/c',
        ];

        foreach ($clusters as $cluster) {
            Golongan::create([
                'cluster' => $cluster
            ]);
        }
    }
}
