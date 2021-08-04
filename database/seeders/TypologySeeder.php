<?php

namespace Database\Seeders;

use App\Models\Typology;
use Illuminate\Database\Seeder;

class TypologySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $typologies = [
            'A',
            'B',
            'C',
            'D1',
            'D2',
        ];

        foreach ($typologies as $typology) {
            Typology::create([
                'name' => $typology,
            ]);
        }
    }
}
