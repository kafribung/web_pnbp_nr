<?php

namespace App\Http\Livewire\Dashboard;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Pernikahan;
use Illuminate\Support\Facades\DB;

class Dashboard extends Component
{
    public $currnetMonth,
            $currnetYear,
            $filterMonth;

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

        // $pernikahans = Db::table('pernikahans')->selectRaw('count(pernikahans.id) as count, desas.name')
        //                 ->join('desas', 'pernikahans.desa_id', 'desas.id')
        //                 ->groupBy('desas.name')
        //                 ->whereMonth('date_time', $this->currnetMonth)
        //                 ->whereYear('date_time', $this->currnetYear)
        //                 ->where('pernikahans.kua_id', auth()->user()->kua_id)
        //                 ->where()
        //                 ->get();

        // dd($pernikahans);

        return view('livewire.dashboard.dashboard', compact('pernikahans'));
    }


}
