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
        
        $pernikahans = Pernikahan::
                        whereMonth('date_time', $this->currnetMonth)
                        ->whereYear('date_time', $this->currnetYear)
                        ->where('kua_id', auth()->user()->kua_id)
                        ->get()
                        ->groupBy('village')
                        ->all();

        // dd($pernikahans);

        return view('livewire.dashboard.dashboard', compact('pernikahans'));
    }


}
