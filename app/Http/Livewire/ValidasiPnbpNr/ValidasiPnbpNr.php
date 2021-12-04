<?php

namespace App\Http\Livewire\ValidasiPnbpNr;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Pernikahan;

class ValidasiPnbpNr extends Component
{
    public $lastYear,
            $oldYear,
            $currnetYear,

            $luarBalaiNikah = [],
            $balaiNikah     = [],
            $kurangMampu    = [],
            $bencanaAlam    = [],
            $isbat          = [];

    public $months;

    public function mount()
    {
        // Get year untuk mengatahui tahun pernikahan paling lama dan terbaru
        if(Pernikahan::count() == 0) {
            $this->lastYear = 2021;
            $this->oldYear  = 2020;
        } else {
            $this->lastYear  = (int)Pernikahan::where('kua_id', auth()->user()->kua_id)->latest()->first()->created_at->format('Y');
            $this->oldYear   = (int)Pernikahan::where('kua_id', auth()->user()->kua_id)->oldest()->first()->created_at->format('Y');
        }

        // Get mount
        $this->currnetYear     = Carbon::now()->year;

        $this->months          = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];

        foreach ($this->months as $index => $month) {
            $this->luarBalaiNikah[] .= Pernikahan::with('peristiwa_nikah', 'desa')->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Luar Balai Nikah'))->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->balaiNikah[]     .= Pernikahan::with('peristiwa_nikah', 'desa')->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Balai Nikah'))->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->kurangMampu[]    .= Pernikahan::with('peristiwa_nikah', 'desa')->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Kurang Mampu'))->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->bencanaAlam[]    .= Pernikahan::with('peristiwa_nikah', 'desa')->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Bencana Alam'))->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
            $this->isbat[]          .= Pernikahan::with('peristiwa_nikah', 'desa')->whereHas('peristiwa_nikah', fn($query) => $query->where('name', 'Isbat'))->whereMonth('date_time', $index+1)->whereYear('date_time', $this->currnetYear)->where('kua_id', auth()->user()->kua_id)->count();
        };

    }

    public function render()
    {
        return view('livewire.validasi-pnbp-nr.validasi-pnbp-nr');
    }
}
