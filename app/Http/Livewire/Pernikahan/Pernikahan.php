<?php

namespace App\Http\Livewire\Pernikahan;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Pernikahan as ModelsPernikahan;

class Pernikahan extends Component
{
    public $modal= false;

    public $search;

    public $lastYear,
            $oldYear,
            $currnetYear,
            $filterAge,
            $currnetMonth;

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function mount()
    {
        // Get year untuk mengatahui tahun pernikahan paling lama dan terbaru
        if(ModelsPernikahan::count() == 0) {
            $this->lastYear = 2021;
            $this->oldYear  = 2020;
        } else {
            $this->lastYear  = (int)ModelsPernikahan::where('kua_id', auth()->user()->kua_id)->latest()->first()->created_at->format('Y');
            $this->oldYear   = (int)ModelsPernikahan::where('kua_id', auth()->user()->kua_id)->oldest()->first()->created_at->format('Y');
        }

        // Get mount
        $this->currnetMonth  = Carbon::now()->month;
        $this->currnetYear   = Carbon::now()->year;
    }

    public function render()
    {
        $pernikahans    = ModelsPernikahan::with('penghulu', 'peristiwa_nikah', 'desa')
                            ->when($this->search, function($query){
                                $query->where('male', 'like',  '%'.$this->search.'%')
                                        ->where('kua_id', auth()->user()->kua_id)
                                    ->orWhere('female', 'like',  '%'.$this->search.'%')
                                        ->where('kua_id', auth()->user()->kua_id)
                                    ->orWhereHas('desa', function($query){
                                        $query->where('name', 'like', '%'. $this->search. '%');
                                    })
                                    ->orWhere('marriage_certificate_number', 'like',  '%'.$this->search.'%')
                                        ->where('kua_id', auth()->user()->kua_id)
                                    ->orWhere('perforation_number', 'like',  '%'.$this->search.'%')
                                        ->where('kua_id', auth()->user()->kua_id)
                                    ->orWhere('date_time', 'like',  '%'.$this->search.'%')
                                        ->where('kua_id', auth()->user()->kua_id)
                                    ->orWhereHas('penghulu', function($query){
                                        $query->where('name', 'like', '%'. $this->search .'%');
                                    })
                                    ->orWhereHas('peristiwa_nikah', function($query){
                                        $query->where('name', 'like', '%'. $this->search .'%');
                                    });
                            })
                            ->whereMonth('date_time', $this->currnetMonth)
                            ->whereYear('date_time', $this->currnetYear)

                            ->when($this->filterAge, function($query){
                                switch ($this->filterAge) {
                                    case 'p<19':
                                        $query->where([
                                            ['male_age', '<', 19],
                                            ['kua_id', auth()->user()->kua_id],
                                        ]);
                                        break;
                                    case 'p>=19&&<=21':
                                        $query->where([
                                            ['male_age', '>=', 19],
                                            ['male_age', '<=', 21],
                                            ['kua_id', auth()->user()->kua_id],
                                        ]);
                                        break;
                                    case 'p>21':
                                        $query->where([
                                            ['male_age', '>', 21],
                                            ['kua_id', auth()->user()->kua_id],
                                        ]);
                                        break;
                                    case 'w<19':
                                        $query->where([
                                            ['female_age', '<', 19],
                                            ['kua_id', auth()->user()->kua_id],
                                        ]);
                                        break;
                                    case 'w>=19&&<=21':
                                        $query->where([
                                            ['female_age', '>=', 19],
                                            ['female_age', '<=', 21],
                                            ['kua_id', auth()->user()->kua_id],
                                        ]);
                                        break;
                                    case 'w>21':
                                        $query->where([
                                            ['female_age', '>', 21],
                                            ['kua_id', auth()->user()->kua_id],
                                        ]);
                                        break;
                                }
                            })
                            ->where('kua_id', auth()->user()->kua_id)
                            ->latest()
                            ->paginate(30);
        return view('livewire.pernikahan.pernikahan', compact('pernikahans'));
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }
}
