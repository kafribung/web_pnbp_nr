<?php

namespace App\Http\Livewire\RekapPnbpNr;

use Carbon\Carbon;
use App\Models\Kua;
use Livewire\Component;
use App\Models\Pernikahan;
use Barryvdh\DomPDF\Facade as PDF;

class RekapPnbpNr extends Component
{
    public $lastYear,
            $oldYear,
            $currentYear,

            $filterKua = 1,
            $kuas,

            $luarBalaiNikah = [],
            $balaiNikah     = [],
            $kurangMampu    = [],
            $bencanaAlam    = [],
            $isbat          = [],
            $lakiLakidiBawah19Tahun  = [],
            $perempuandiBawah19Tahun = [],
            $lakiLaki19Sampai21Tahun  = [],
            $perempuan19Sampai21Tahun = [],
            $lakiLakidiAtas21Tahun  = [],
            $perempuandiAtas21Tahun = [],

            $pernikahanLuarBalaiAcc_count = [],
            $pernikahanLuarBalai_count    = [];

    public $months;

    // protected $listeners = ['render'];

    public function mount()
    {
        // Get year untuk mengatahui tahun pernikahan paling lama dan terbaru
        if(Pernikahan::count() == 0 || !auth()->user()->kua) {
            $this->lastYear = Carbon::now()->year;
            $this->oldYear  = Carbon::now()->subYear()->year;
        } else {
            $this->lastYear  = (int)Pernikahan::where('kua_id', auth()->user()->kua_id)->latest()->first()->created_at->format('Y');
            $this->oldYear   = (int)Pernikahan::where('kua_id', auth()->user()->kua_id)->oldest()->first()->created_at->format('Y');
        }

        // Get mount
        $this->currentYear     = Carbon::now()->year;

        $this->months          = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        $this->kuas            = Kua::get(['name', 'id']);
    }

    public function updatedcurrentYear($value)
    {
        $this->resetFields();
    }

    public function updatedFilterKua()
    {
        $this->resetFields();
    }

    public function data()
    {

        if (!auth()->user()->kua_id) $filterKua = $this->filterKua;
        else $filterKua = auth()->user()->kua_id;

        foreach ($this->months as $index => $month) {
            // Peristiwa nikah
            $this->luarBalaiNikah[] .= Pernikahan::with('peristiwa_nikah', 'desa')->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Luar Balai Nikah'))->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currentYear)->where('kua_id', $filterKua)->count();
            $this->balaiNikah[]     .= Pernikahan::with('peristiwa_nikah', 'desa')->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Balai Nikah'))->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currentYear)->where('kua_id', $filterKua)->count();
            $this->kurangMampu[]    .= Pernikahan::with('peristiwa_nikah', 'desa')->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Kurang Mampu'))->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currentYear)->where('kua_id', $filterKua)->count();
            $this->bencanaAlam[]    .= Pernikahan::with('peristiwa_nikah', 'desa')->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Bencana Alam'))->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currentYear)->where('kua_id', $filterKua)->count();
            $this->isbat[]          .= Pernikahan::with('peristiwa_nikah', 'desa')->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Isbat'))->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currentYear)->where('kua_id', $filterKua)->count();

            // Dibawah 19 tahun
            $this->lakiLakidiBawah19Tahun[] .= Pernikahan::with('peristiwa_nikah', 'desa')->where('male_age', '<', 19)->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currentYear)->where('kua_id', $filterKua)->count();
            $this->perempuandiBawah19Tahun[].= Pernikahan::with('peristiwa_nikah', 'desa')->where('female_age', '<', 19)->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currentYear)->where('kua_id', $filterKua)->count();

            // 19-21 tahun
            $this->lakiLaki19Sampai21Tahun[] .= Pernikahan::with('peristiwa_nikah', 'desa')->where('male_age', '>=', 19)->where('male_age', '<=', 21)->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currentYear)->where('kua_id', $filterKua)->count();
            $this->perempuan19Sampai21Tahun[].= Pernikahan::with('peristiwa_nikah', 'desa')->where('female_age', '>=', 19)->where('female_age', '<=', 21)->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currentYear)->where('kua_id', $filterKua)->count();

            // Di atas 21 tahun
            $this->lakiLakidiAtas21Tahun[] .= Pernikahan::with('peristiwa_nikah', 'desa')->where('male_age', '>', 21)->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currentYear)->where('kua_id', $filterKua)->count();
            $this->perempuandiAtas21Tahun[].= Pernikahan::with('peristiwa_nikah', 'desa')->where('female_age', '>', 21)->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currentYear)->where('kua_id', $filterKua)->count();

            $this->pernikahanLuarBalaiAcc_count[] .= Pernikahan::where('approve', 'acc')
                                                    ->whereMonth('date_time', $index+1)
                                                    ->whereYear('date_time', $this->currentYear)
                                                    ->where('kua_id', $filterKua)
                                                    ->count();
            $this->pernikahanLuarBalai_count[]   .= Pernikahan::whereMonth('date_time', $index+1)
                                                    ->whereYear('date_time', $this->currentYear)
                                                    ->where('kua_id', $filterKua)
                                                    ->count();
        };
    }


    public function render()
    {
        $this->data();
        return view('livewire.rekap-pnbp-nr.rekap-pnbp-nr');
    }

    public function resetFields()
    {
        $this->luarBalaiNikah          = [];
        $this->balaiNikah              = [];
        $this->kurangMampu             = [];
        $this->bencanaAlam             = [];
        $this->isbat                   = [];
        $this->lakiLakidiBawah19Tahun  = [];
        $this->perempuandiBawah19Tahun = [];
        $this->lakiLaki19Sampai21Tahun = [];
        $this->perempuan19Sampai21Tahun= [];
        $this->lakiLakidiAtas21Tahun   = [];
        $this->perempuandiAtas21Tahun  = [];
        $this->pernikahanLuarBalaiAcc_count = [];
        $this->pernikahanLuarBalai_count    = [];
    }
}
