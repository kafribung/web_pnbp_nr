<?php

namespace App\Http\Livewire\Dashboard;

use App\Models\Desa;
use Carbon\Carbon;
use Livewire\Component;
use App\Models\Pernikahan;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $currnetMonth,
            $currnetYear,
            $filterMonth;

    public $luarBalaiNikah      = [],
            $dalamBalaiNikah    = [],
            $tidakMampu         = [],
            $musibahAlam        = [],
            $sidangIsbat        = [],

            $lakiDibawah19Tahun        = [],
            $perempuanDibawah19Tahun   = [],
            $laki19Sampai21Tahun       = [],
            $perempuan19Sampai21Tahun  = [],
            $lakiDiatas21Tahun         = [],
            $perempuanDiatas21Tahun    = []

            ;


    public function mount()
    {
        // Get mount
        $this->currnetMonth  = Carbon::now()->month;
        $this->currnetYear   = Carbon::now()->year;
    }

    public function render()
    {

        $pernikahans = Pernikahan::with('desa')
                        ->whereMonth('date_time', $this->currnetMonth)
                        ->whereYear('date_time', $this->currnetYear)
                        ->where('kua_id', auth()->user()->kua_id)
                        ->whereHas('desa', function($query){
                            $query->groupBy('name');
                        })
                        ->get();

        $desas       = Desa::where('kua_id', auth()->user()->kua_id)->get();

        foreach ($desas as $desa) {
            $this->luarBalaiNikah[]    .= Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Luar Balai Nikah'))->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->dalamBalaiNikah[]   .= Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Balai Nikah'))->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->tidakMampu[]        .= Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Kurang Mampu'))->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->musibahAlam[]       .= Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Bencana Alam'))->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->sidangIsbat[]       .= Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Isbat'))->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();

            $this->lakiDibawah19Tahun[]       .= Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('male_age', '<', 19)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->perempuanDibawah19Tahun[]  .= Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('female_age', '<', 19)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->laki19Sampai21Tahun[]      .= Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('male_age', '>=', 19)->where('male_age', '<=', 21)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->perempuan19Sampai21Tahun[] .= Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('female_age', '>=', 19)->where('female_age', '<=', 21)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->lakiDiatas21Tahun[]        .= Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('male_age', '>', 21)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->perempuanDiatas21Tahun[]   .= Pernikahan::whereHas('desa', fn($query) => $query->where('name', $desa->name))->where('female_age', '>', 21)->whereMonth('date_time', $this->currnetMonth)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
        }


        // $pernikahans = Db::table('pernikahans')->selectRaw('count(pernikahans.id) as count, desas.name')
        //                 ->join('desas', 'pernikahans.desa_id', 'desas.id')
        //                 ->groupBy('desas.name')
        //                 ->whereMonth('date_time', $this->currnetMonth)
        //                 ->whereYear('date_time', $this->currnetYear)
        //                 ->where('pernikahans.kua_id', auth()->user()->kua_id)
        //                 ->where()
        //                 ->get();


        // dd($pernikahans);

        return view('livewire.dashboard.dashboard', compact('pernikahans', 'desas'));
    }


}
