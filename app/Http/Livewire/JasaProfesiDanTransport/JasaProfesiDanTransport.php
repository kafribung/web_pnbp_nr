<?php

namespace App\Http\Livewire\JasaProfesiDanTransport;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Penghulu;
use App\Models\Pernikahan;
use Illuminate\Database\Eloquent\Builder;

class JasaProfesiDanTransport extends Component
{
    public $search;
    protected $queryString = ['search'];

    public $lastYear,
            $oldYear,
            $currnetMonth,
            $currnetYear;

    public $totalPermohonanPembayaran = null;

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
        $this->currnetMonth  = Carbon::now()->month;
        $this->currnetYear   = Carbon::now()->year;
    }

    public function updatedtotalPermohonanPembayaran($value)
    {
        $this->totalPermohonanPembayaran = $value;
        dd($value);
    }

    public function render()
    {
        $penghulus = Penghulu::with('pernikahans')
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
                    ->when($this->search, function($query){
                        $query->where('name', 'like',  '%'.$this->search.'%');
                    })
                    ->where('penghulus.kua_id', auth()->user()->kua_id)
                    ->get();
        return view('livewire.jasa-profesi-dan-transport.jasa-profesi-dan-transport', compact('penghulus'));
    }
}
