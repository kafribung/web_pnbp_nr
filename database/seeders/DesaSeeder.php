<?php

namespace Database\Seeders;

use App\Models\Desa;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Http;

class DesaSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        // // Mamuju
        // $mamujus        = Http::get('https://ibnux.github.io/data-indonesia/kelurahan/760201.json');
        // $mamujus        = $mamujus->json();

        // foreach ($mamujus as $desa) {
        //     Desa::create([
        //         'name'    => $desa["nama"],
        //         "kua_id"  => 5
        //     ]);
        // }

        // Tapalang
        $tapalangs        = Http::get('https://ibnux.github.io/data-indonesia/kelurahan/760202.json');
        $tapalangs        = $tapalangs->json();

        foreach ($tapalangs as $desa) {
            Desa::create([
                'name'    => $desa["nama"],
                "kua_id"  => 9
            ]);
        }

        // Kalukku
        $kalukkus        = Http::get('https://ibnux.github.io/data-indonesia/kelurahan/760203.json');
        $kalukkus        = $kalukkus->json();

        foreach ($kalukkus as $desa) {
            Desa::create([
                'name'    => $desa["nama"],
                "kua_id"  => 2
            ]);
        }

        // Kalumpang
        $kalumpangs        = Http::get('https://ibnux.github.io/data-indonesia/kelurahan/760204.json');
        $kalumpangs        = $kalumpangs->json();

        foreach ($kalumpangs as $desa) {
            Desa::create([
                'name'    => $desa["nama"],
                "kua_id"  => 3
            ]);
        }

        // Papalang
        $papalangs        = Http::get('https://ibnux.github.io/data-indonesia/kelurahan/760207.json');
        $papalangs        = $papalangs->json();

        foreach ($papalangs as $desa) {
            Desa::create([
                'name'    => $desa["nama"],
                "kua_id"  => 6
            ]);
        }

        // Sampaga
        $sampagas        = Http::get('https://ibnux.github.io/data-indonesia/kelurahan/760208.json');
        $sampagas        = $sampagas->json();

        foreach ($sampagas as $desa) {
            Desa::create([
                'name'    => $desa["nama"],
                "kua_id"  => 7
            ]);
        }

        // Tommo
        $tommos        = Http::get('https://ibnux.github.io/data-indonesia/kelurahan/760211.json');
        $tommos        = $tommos->json();

        foreach ($tommos as $desa) {
            Desa::create([
                'name'    => $desa["nama"],
                "kua_id"  => 11
            ]);
        }

        // Simboro dan Kepulauan
        $simboroKepulauans        = Http::get('https://ibnux.github.io/data-indonesia/kelurahan/760212.json');
        $simboroKepulauans        = $simboroKepulauans->json();

        foreach ($simboroKepulauans as $desa) {
            Desa::create([
                'name'    => $desa["nama"],
                "kua_id"  => 8
            ]);
        }

        // Tapalang Barat
        $tapalangBarats        = Http::get('https://ibnux.github.io/data-indonesia/kelurahan/760213.json');
        $tapalangBarats        = $tapalangBarats->json();

        foreach ($tapalangBarats as $desa) {
            Desa::create([
                'name'    => $desa["nama"],
                "kua_id"  => 10
            ]);
        }

        // Bonehau
        $bonehaus        = Http::get('https://ibnux.github.io/data-indonesia/kelurahan/760215.json');
        $bonehaus        = $bonehaus->json();

        foreach ($bonehaus as $desa) {
            Desa::create([
                'name'    => $desa["nama"],
                "kua_id"  => 1
            ]);
        }

        // Kep. Bala Balakang
        $kepBalaBalakangs        = Http::get('https://ibnux.github.io/data-indonesia/kelurahan/760216.json');
        $kepBalaBalakangs        = $kepBalaBalakangs->json();

        foreach ($kepBalaBalakangs as $desa) {
            Desa::create([
                'name'    => $desa["nama"],
                "kua_id"  => 4
            ]);
        }

    }
}
