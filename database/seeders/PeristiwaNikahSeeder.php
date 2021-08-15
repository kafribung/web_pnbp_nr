<?php

namespace Database\Seeders;

use App\Models\PeristiwaNikah;
use Illuminate\Database\Seeder;

class PeristiwaNikahSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $peristiwaNikahs = [
            'Balai Nikah',
            'Luar Balai Nikah',
            'Kurang Mampu',
            'Bencana Alam',
            'Isbat'
        ];

        foreach ($peristiwaNikahs as $peristiwaNikah) {
            PeristiwaNikah::create([
                'name' => $peristiwaNikah,
            ]);
        }
    }
}
