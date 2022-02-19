<?php

namespace App\Http\Livewire\JasaProfesiDanTransport;

use Carbon\Carbon;
use App\Models\Kua;
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
            $currnetYear,
            $kuas,
            $filterKua = 1;

    public function mount()
    {
        // Get year untuk mengatahui tahun pernikahan paling lama dan terbaru
        if(Pernikahan::count() == 0 || !auth()->user()->kua) {
            $this->lastYear = 2022;
            $this->oldYear  = 2021;
        } else {
            $this->lastYear  = (int)Pernikahan::where('kua_id', auth()->user()->kua_id)->latest()->first()->created_at->format('Y');
            $this->oldYear   = (int)Pernikahan::where('kua_id', auth()->user()->kua_id)->oldest()->first()->created_at->format('Y');
        }

        // Get mount
        $this->currnetMonth  = Carbon::now()->month;
        $this->currnetYear   = Carbon::now()->year;

        $this->kuas          = Kua::get(['name', 'id']);


    }

    public function render()
    {

        if (!auth()->user()->kua_id) $filterKua = $this->filterKua;
        else $filterKua = auth()->user()->kua_id;

        $penghulus = Penghulu::with('pernikahans')
                    ->select('penghulus.*')
                    ->withCount(['pernikahans as luar_balai_nikah_count' => function ($query) use($filterKua){
                        $query
                        ->whereHas('peristiwa_nikah', fn($q) => $q->where('name', 'Luar Balai Nikah'))
                        ->where(function($q) use($filterKua){
                            $q
                            ->whereMonth('date_time', $this->currnetMonth)
                            ->whereYear('date_time', $this->currnetYear)
                            ->where('kua_id', $filterKua);
                        });
                    }])
                    ->leftJoin('pernikahans', 'pernikahans.penghulu_id', '=', 'penghulus.id')
                    ->when($this->search, function($query){
                        $query->where('name', 'like',  '%'.$this->search.'%');
                    })
                    ->where('penghulus.kua_id', $filterKua)
                    ->get();

        $pernikahanLuarBalai_count = Pernikahan::whereHas('peristiwa_nikah', function($q){
                                        $q->where('name', 'Luar Balai Nikah');
                                    })
                                    ->where('approve', 'acc')
                                    ->whereMonth('date_time', $this->currnetMonth)
                                    ->whereYear('date_time', $this->currnetYear)
                                    ->where('kua_id', 4)
                                    ->count();
                                dd($pernikahanLuarBalai_count);

        return view('livewire.jasa-profesi-dan-transport.jasa-profesi-dan-transport', compact('penghulus', 'pernikahanLuarBalai_count'));
    }
}
