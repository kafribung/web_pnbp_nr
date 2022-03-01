<?php

namespace App\Http\Controllers;

use App\Models\{Kua, Pernikahan};
use Illuminate\Http\Request;
use Illuminate\Support\Carbon;

class PrintKuaController extends Controller
{
    public $currentMonth = null;
    public $currentYear  = null;

    public function __invoke($currentMonth, $currentYear, $filterKua = false)
    {
        $this->currentMonth = $currentMonth;
        $this->currentYear  = $currentYear;

        $bulan              = Carbon::createFromDate($currentYear, $currentMonth)->month($currentMonth)->isoFormat('MMMM');
        $tanggalLengkap     = Carbon::createFromDate($currentYear, $currentMonth)->month($currentMonth)->isoFormat('D MMMM Y');

        $kuas         = Kua::select('pernikahans.*', 'kuas.name as name')
                            ->withCount(['pernikahans as luar_balai_nikah_count' => function ($query){
                                $query
                                ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Luar Balai Nikah'))
                                ->where(function($q){
                                    $q
                                    ->whereMonth('date_time', $this->currentMonth)
                                    ->whereYear('date_time', $this->currentYear);
                                });
                            }])
                            ->withCount(['pernikahans as balai_nikah_count' => function ($query){
                                $query
                                ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Balai Nikah'))
                                ->where(function($q){
                                    $q
                                    ->whereMonth('date_time', $this->currentMonth)
                                    ->whereYear('date_time', $this->currentYear);
                                });
                            }])
                            ->withCount(['pernikahans as kurang_mampu_count' => function ($query){
                                $query
                                ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Kurang Mampu'))
                                ->where(function($q){
                                    $q
                                    ->whereMonth('date_time', $this->currentMonth)
                                    ->whereYear('date_time', $this->currentYear);
                                });
                            }])
                            ->withCount(['pernikahans as bencana_alam_count' => function ($query){
                                $query
                                ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Bencana Alam'))->where(function($q){
                                    $q
                                    ->whereMonth('date_time', $this->currentMonth)
                                    ->whereYear('date_time', $this->currentYear);
                                });
                            }])
                            ->withCount(['pernikahans as isbat_count' => function ($query){
                                $query
                                ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Isbat'))
                                ->where(function($q){
                                    $q
                                    ->whereMonth('date_time', $this->currentMonth)
                                    ->whereYear('date_time', $this->currentYear);
                                });
                            }])
                            ->withCount(['pernikahans as pria_dibawah_19_tahun_count' => function ($query){
                                $query
                                ->where(function($q){
                                    $q
                                    ->where('male_age', '<', 19)
                                    ->whereMonth('date_time', $this->currentMonth)
                                    ->whereYear('date_time', $this->currentYear);
                                });
                            }])
                            ->withCount(['pernikahans as wanita_dibawah_19_tahun_count' => function ($query){
                                $query
                                ->where(function($q){
                                    $q
                                    ->where('female_age', '<', 19)
                                    ->whereMonth('date_time', $this->currentMonth)
                                    ->whereYear('date_time', $this->currentYear);
                                });
                            }])
                            ->withCount(['pernikahans as pria_19_sampai_21_tahun_count' => function ($query){
                                $query
                                ->where(function($q){
                                    $q
                                    ->where('male_age', '>=', 19)
                                    ->where('male_age', '<=', 21)
                                    ->whereMonth('date_time', $this->currentMonth)
                                    ->whereYear('date_time', $this->currentYear);
                                });
                            }])
                            ->withCount(['pernikahans as wanita_19_sampai_21_tahun_count' => function ($query){
                                $query
                                ->where(function($q){
                                    $q
                                    ->where('female_age', '>=', 19)
                                    ->where('female_age', '<=', 21)
                                    ->whereMonth('date_time', $this->currentMonth)
                                    ->whereYear('date_time', $this->currentYear);
                                });
                            }])
                            ->withCount(['pernikahans as pria_diatas_21_tahun_count' => function ($query){
                                $query
                                ->where(function($q){
                                    $q
                                    ->where('male_age', '>', 21)
                                    ->whereMonth('date_time', $this->currentMonth)
                                    ->whereYear('date_time', $this->currentYear);
                                });
                            }])
                            ->withCount(['pernikahans as wanita_diatas_21_tahun_count' => function ($query){
                                $query
                                ->where(function($q){
                                    $q
                                    ->where('female_age', '>', 21)
                                    ->whereMonth('date_time', $this->currentMonth)
                                    ->whereYear('date_time', $this->currentYear);
                                });
                            }])
                            ->leftJoin('pernikahans', 'pernikahans.kua_id', '=', 'kuas.id')
                            ->get();

        $pernikahanLuarBalaiAcc_count = Pernikahan::whereHas('peristiwa_nikah', function($q){
                                $q->where('name', 'Luar Balai Nikah');
                            })
                            ->where('approve', 'acc')
                            ->whereMonth('date_time', $this->currentMonth)
                            ->whereYear('date_time', $this->currentYear)
                            ->count();

        $pernikahanLuarBalai_count = Pernikahan::whereHas('peristiwa_nikah', function($q){
                                $q->where('name', 'Luar Balai Nikah');
                            })
                            ->whereMonth('date_time', $this->currentMonth)
                            ->whereYear('date_time', $this->currentYear)
                            ->count();

        return view('prints.print', compact(
            'kuas',
            'filterKua',
            'currentYear',
            'currentMonth',
            'bulan',
            'tanggalLengkap',
            'pernikahanLuarBalaiAcc_count',
            'pernikahanLuarBalai_count'
        ));
    }
}
