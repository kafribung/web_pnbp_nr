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
        $names = [
            'Penghulu Pertama -  III/a',
            'Penghulu Pertama - III/b',
            'Penghulu Muda - III/c',
            'Penghulu Muda - III/d',
            'Penghulu Madya - IV/a',
            'Penghulu Madya - IV/b',
            'Penghulu Madya - IV/c',
        ];

        foreach ($names as $name) {
            Golongan::create([
                'name' => $name
            ]);
        }
    }
}
