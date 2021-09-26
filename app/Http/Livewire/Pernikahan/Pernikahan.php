<?php

namespace App\Http\Livewire\Pernikahan;

use App\Models\Pernikahan as ModelsPernikahan;
use Livewire\Component;

class Pernikahan extends Component
{
    public $modal= false;

    public $search;
    protected $queryString = ['search'];

    public $lastYear,
            $oldYear,
            $filterYear,
            $filterAge,
            $filterMonth;

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function mount()
    {
        $this->lastYear  = (int)ModelsPernikahan::latest()->first()->created_at->format('Y');
        $this->oldYear   = (int)ModelsPernikahan::oldest()->first()->created_at->format('Y');
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
                            ->when($this->filterMonth, function($query){
                                $query->whereMonth('date_time', $this->filterMonth)
                                        ->where('kua_id', auth()->user()->kua_id);
                            })
                            ->when($this->filterYear, function($query){
                                $query->whereYear('date_time', $this->filterYear)
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
