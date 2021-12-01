<?php

namespace App\Http\Livewire\ValidasiPnbpNr;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Pernikahan;

class ValidasiPnbpNr extends Component
{
    public $lastYear,
            $oldYear,
            $currnetYear;

    public $months;

    public function mount()
    {
        // Get year untuk mengatahui tahun pernikahan paling lama dan terbaru
        $this->lastYear  = (int)Pernikahan::where('kua_id', auth()->user()->kua_id)->latest()->first()->created_at->format('Y');
        $this->oldYear   = (int)Pernikahan::where('kua_id', auth()->user()->kua_id)->oldest()->first()->created_at->format('Y');

        // Get mount
        $this->currnetYear   = Carbon::now()->year;

        $this->months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
    }

    public function render()
    {
        return view('livewire.validasi-pnbp-nr.validasi-pnbp-nr');
    }
}
