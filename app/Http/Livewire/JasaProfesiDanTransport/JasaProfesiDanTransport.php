<?php

namespace App\Http\Livewire\JasaProfesiDanTransport;

use App\Models\Penghulu;
use App\Models\Pernikahan;
use Carbon\Carbon;
use Livewire\Component;

class JasaProfesiDanTransport extends Component
{
    public function render()
    {
        $penghulus = Penghulu::with('pernikahans', 'golongan')
                    ->whereHas('pernikahans', function($query){
                        $query->whereMonth('date_time', Carbon::now()->month)
                                ->whereYear('date_time', Carbon::now()->year);
                    })
                    ->where('kua_id', auth()->user()->kua_id)
                    ->get();

        return view('livewire.jasa-profesi-dan-transport.jasa-profesi-dan-transport', compact('penghulus'));
    }
}
