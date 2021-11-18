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

    public function mount()
    {
        // Get year untuk mengatahui tahun pernikahan paling lama dan terbaru
        $this->lastYear  = (int)Pernikahan::latest()->first()->created_at->format('Y');
        $this->oldYear   = (int)Pernikahan::oldest()->first()->created_at->format('Y');

        // Get mount
        $this->currnetMonth  = Carbon::now()->month;
        $this->currnetYear   = Carbon::now()->year;
    }

    public function render()
    {
        $penghulus = Penghulu::with('pernikahans')->whereHas('pernikahans', function($query){
                            $query
                            ->whereHas('peristiwa_nikah', function($query){
                                $query->where('name', 'Luar Balai Nikah');
                            })
                            ->whereMonth('date_time', $this->currnetMonth)
                            ->whereYear('date_time', $this->currnetYear);
                        })
                        ->when($this->search, function($query){
                            $query->where('name', 'like',  '%'.$this->search.'%');
                        })
                        ->where('kua_id', auth()->user()->kua_id)
                        ->get();
        return view('livewire.jasa-profesi-dan-transport.jasa-profesi-dan-transport', compact('penghulus'));
    }
}
