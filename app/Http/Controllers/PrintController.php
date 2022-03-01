<?php

namespace App\Http\Controllers;

use Carbon\Carbon;
use App\Models\Kua;
use App\Models\{Desa, Pernikahan, Penghulu};

class PrintController extends Controller
{
    /**
     * Handle the incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public $currentMonth = null;
    public $currentYear  = null;


    public function __invoke($currentMonth, $currentYear, $filterKua, $semuaKUA = false)
    {
        $this->currentMonth = $currentMonth;
        $this->currentYear  = $currentYear;

        $kua                = Kua::find($filterKua);;
        $kuaLeader          = Kua::find($filterKua)->penghulus->where('kua_leader', 1)->first();

        $bulan              = Carbon::createFromDate($currentYear, $currentMonth)->month($currentMonth)->isoFormat('MMMM');
        $tanggalLengkap     = Carbon::createFromDate($currentYear, $currentMonth)->month($currentMonth)->isoFormat('D MMMM Y');

        // Redirect jika tidak ada data.
        if (Pernikahan::where('kua_id', $filterKua)->whereMonth('date_time', $this->currentMonth)->whereYear('date_time', $this->currentYear)->count() == 0) {
            session()->flash('message', 'Data rekapan tidak ditemukan');
            return redirect('rekap-pnbp-nr');
        }

        // Redirect jika mengakses KUA lain.
        if (auth()->user()->kua) {
            if (auth()->user()->kua_id != $filterKua ) {
                session()->flash('message', 'Anda tidak dapat mengakses data rekapan milik KUA lain!');
                return redirect('rekap-pnbp-nr');
            }
        }

        $desas        = Desa::select('pernikahans.*', 'desas.name as name')
                        ->withCount(['pernikahans as luar_balai_nikah_count' => function ($query) use($filterKua){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Luar Balai Nikah'))
                            ->where(function($q) use($filterKua){
                                $q
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])
                        ->withCount(['pernikahans as balai_nikah_count' => function ($query) use($filterKua){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Balai Nikah'))
                            ->where(function($q) use($filterKua){
                                $q
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])
                        ->withCount(['pernikahans as kurang_mampu_count' => function ($query) use($filterKua){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Kurang Mampu'))
                            ->where(function($q) use($filterKua){
                                $q
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])
                        ->withCount(['pernikahans as bencana_alam_count' => function ($query) use($filterKua){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Bencana Alam'))->where(function($q) use($filterKua){
                                $q
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])
                        ->withCount(['pernikahans as isbat_count' => function ($query) use($filterKua){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Isbat'))
                            ->where(function($q) use($filterKua){
                                $q
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])

                        ->withCount(['pernikahans as pria_dibawah_19_tahun_count' => function ($query) use($filterKua){
                            $query
                            ->where(function($q) use($filterKua){
                                $q
                                ->where('male_age', '<', 19)
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])
                        ->withCount(['pernikahans as wanita_dibawah_19_tahun_count' => function ($query) use($filterKua){
                            $query
                            ->where(function($q) use($filterKua){
                                $q
                                ->where('female_age', '<', 19)
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])
                        ->withCount(['pernikahans as pria_19_sampai_21_tahun_count' => function ($query) use($filterKua){
                            $query
                            ->where(function($q) use($filterKua){
                                $q
                                ->where('male_age', '>=', 19)
                                ->where('male_age', '<=', 21)
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])
                        ->withCount(['pernikahans as wanita_19_sampai_21_tahun_count' => function ($query) use($filterKua){
                            $query
                            ->where(function($q) use($filterKua){
                                $q
                                ->where('female_age', '>=', 19)
                                ->where('female_age', '<=', 21)
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])
                        ->withCount(['pernikahans as pria_diatas_21_tahun_count' => function ($query) use($filterKua){
                            $query
                            ->where(function($q) use($filterKua){
                                $q
                                ->where('male_age', '>', 21)
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])
                        ->withCount(['pernikahans as wanita_diatas_21_tahun_count' => function ($query) use($filterKua){
                            $query
                            ->where(function($q) use($filterKua){
                                $q
                                ->where('female_age', '>', 21)
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])
                        ->leftJoin('pernikahans', 'pernikahans.desa_id', '=', 'desas.id')
                        ->where('desas.kua_id', $filterKua)->get();

        $pernikahans  = Pernikahan::with('penghulu', 'peristiwa_nikah', 'desa')
                        ->whereMonth('date_time', $this->currentMonth)
                        ->whereYear('date_time', $this->currentYear)
                        ->where('kua_id', $filterKua)
                        ->latest()
                        ->get();

        $penghulus     = Penghulu::with('pernikahans')
                        ->select('penghulus.*')
                        ->withCount(['pernikahans as luar_balai_nikah_count' => function ($query) use($filterKua){
                            $query
                            ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Luar Balai Nikah'))
                            ->where(function($q) use($filterKua){
                                $q
                                ->whereMonth('date_time', $this->currentMonth)
                                ->whereYear('date_time', $this->currentYear)
                                ->where('kua_id', $filterKua);
                            });
                        }])
                        ->leftJoin('pernikahans', 'pernikahans.penghulu_id', '=', 'penghulus.id')
                        ->where('penghulus.kua_id', $filterKua)
                        ->get();
        return view('prints.print', compact('kua', 'kuaLeader', 'bulan', 'tanggalLengkap', 'desas', 'currentMonth', 'currentYear', 'pernikahans', 'penghulus', 'filterKua'));
    }
}
