<?php

namespace App\Http\Controllers;

use App\Models\{Desa, Pernikahan, Penghulu};
class PrintController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $currnetMonth = 1;
    public $currnetYear  = 2022;
    public function __invoke()
    {
        $currnetMonth = $this->currnetMonth;
        $currnetYear = $this->currnetYear;

        $desas        = Desa::select('pernikahans.*', 'desas.name as name')
                        ->withCount(['pernikahans as luar_balai_nikah_count' => function ($query){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Luar Balai Nikah'))
                            ->where(function($q){
                                $q
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])
                        ->withCount(['pernikahans as balai_nikah_count' => function ($query){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Balai Nikah'))
                            ->where(function($q){
                                $q
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])
                        ->withCount(['pernikahans as kurang_mampu_count' => function ($query){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Kurang Mampu'))
                            ->where(function($q){
                                $q
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])
                        ->withCount(['pernikahans as bencana_alam_count' => function ($query){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Bencana Alam'))->where(function($q){
                                $q
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])
                        ->withCount(['pernikahans as isbat_count' => function ($query){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Isbat'))
                            ->where(function($q){
                                $q
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])

                        ->withCount(['pernikahans as pria_dibawah_19_tahun_count' => function ($query){
                            $query
                            ->where(function($q){
                                $q
                                ->where('male_age', '<', 19)
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])
                        ->withCount(['pernikahans as wanita_dibawah_19_tahun_count' => function ($query){
                            $query
                            ->where(function($q){
                                $q
                                ->where('female_age', '<', 19)
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])
                        ->withCount(['pernikahans as pria_19_sampai_21_tahun_count' => function ($query){
                            $query
                            ->where(function($q){
                                $q
                                ->where('male_age', '>=', 19)
                                ->where('male_age', '<=', 21)
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])
                        ->withCount(['pernikahans as wanita_19_sampai_21_tahun_count' => function ($query){
                            $query
                            ->where(function($q){
                                $q
                                ->where('female_age', '>=', 19)
                                ->where('female_age', '<=', 21)
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])
                        ->withCount(['pernikahans as pria_diatas_21_tahun_count' => function ($query){
                            $query
                            ->where(function($q){
                                $q
                                ->where('male_age', '>', 21)
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])
                        ->withCount(['pernikahans as wanita_diatas_21_tahun_count' => function ($query){
                            $query
                            ->where(function($q){
                                $q
                                ->where('female_age', '>', 21)
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])
                        ->leftJoin('pernikahans', 'pernikahans.desa_id', '=', 'desas.id')
                        ->where('desas.kua_id', auth()->user()->kua_id)->get();

        $pernikahans  = Pernikahan::with('penghulu', 'peristiwa_nikah', 'desa')
                        ->whereMonth('date_time', $this->currnetMonth)
                        ->whereYear('date_time', $this->currnetYear)
                        ->where('kua_id', auth()->user()->kua_id)
                        ->latest()
                        ->get();

        $penghulus     = Penghulu::with('pernikahans')
                        ->select('penghulus.*')
                        ->withCount(['pernikahans as luar_balai_nikah_count' => function ($query){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Luar Balai Nikah'))
                            ->where(function($q){
                                $q
                                ->whereMonth('date_time', $this->currnetMonth)
                                ->whereYear('date_time', $this->currnetYear)
                                ->where('kua_id', auth()->user()->kua_id);
                            });
                        }])
                        ->leftJoin('pernikahans', 'pernikahans.penghulu_id', '=', 'penghulus.id')
                        ->where('penghulus.kua_id', auth()->user()->kua_id)
                        ->get();
        return view('prints.print', compact('desas', 'currnetMonth', 'currnetYear', 'pernikahans', 'penghulus'));
    }
}
