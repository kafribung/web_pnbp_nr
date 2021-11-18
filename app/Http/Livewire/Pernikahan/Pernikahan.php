<?php

namespace App\Http\Livewire\Pernikahan;

use Carbon\Carbon;
use Livewire\Component;
use App\Models\Pernikahan as ModelsPernikahan;

class Pernikahan extends Component
{
    public $modal= false;

    public $search;
    protected $queryString = ['search'];

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
        $this->lastYear  = (int)ModelsPernikahan::latest()->first()->created_at->format('Y');
        $this->oldYear   = (int)ModelsPernikahan::oldest()->first()->created_at->format('Y');

        // Get mount
        $this->currnetMonth  = Carbon::now()->month;
        $this->currnetYear   = Carbon::now()->year;
    }

    public function render()
    {
        $pernikahans    = ModelsPernikahan::with('penghulu')
                            ->when($this->search, function($query){
                                $query->where('male', 'like',  '%'.$this->search.'%')
                                        ->where('kua_id', auth()->user()->kua_id)
                                    ->orWhere('female', 'like',  '%'.$this->search.'%')
                                        ->where('kua_id', auth()->user()->kua_id)
                                    ->orWhere('village', 'like',  '%'.$this->search.'%')
                                        ->where('kua_id', auth()->user()->kua_id)
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
                            ->when($this->currnetMonth, function($query){
                                $query->whereMonth('date_time', $this->currnetMonth)
                                        ->where('kua_id', auth()->user()->kua_id);
                            })
                            ->when($this->currnetYear, function($query){
                                $query->whereYear('date_time', $this->currnetYear)
                                        ->where('kua_id', auth()->user()->kua_id);
                            })
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
