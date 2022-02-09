<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\{Desa, Penghulu};
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Pernikahan;

class Dashboard extends Component
{
    public $currnetMonth,
            $currnetYear,
            $semuaDesa = false;

    public $totPermohonanPembayaran;

    public function mount()
    {
        // Get mount
        $this->currnetMonth  = Carbon::now()->month;
        $this->currnetYear   = Carbon::now()->year;
    }

    // id pendapatan bulan tahun kua
    public function permohonanPembayaran($count)
    {
        $this->jumPermohonanPembayaran =$count;
    }

    public function render()
    {
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
                        ->when($this->semuaDesa,
                            function($q){
                                return $q->leftJoin('pernikahans', 'pernikahans.desa_id', '=', 'desas.id');
                            },
                            function($q) {
                                return $q->join('pernikahans', 'pernikahans.desa_id', '=', 'desas.id');
                            }
                        )
                        ->where('desas.kua_id', auth()->user()->kua_id)->get();

        $penghuluCount = Penghulu::where('kua_id', auth()->user()->kua_id)->count();
        $desaCount     = Desa::where('kua_id', auth()->user()->kua_id)->count();

        return view('livewire.dashboard.dashboard', compact('desas', 'penghuluCount', 'desaCount'));
    }
}
