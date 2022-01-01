<?php

namespace App\Http\Livewire\Pernikahan;

use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Models\Pernikahan as ModelsPernikahan;
use Livewire\WithPagination;

class Pernikahan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'costume';
    public $modal= false;

    public $search;

    public $lastYear,
            $oldYear,
            $currnetYear,
            $filterAge,
            $currnetMonth;

    public $dateRange = [];

    protected $listeners = [
        'refreshParent' => '$refresh'
    ];

    public function mount()
    {
        $this->dateRange = [Carbon::now()->firstOfMonth()->format('d/m/Y'), Carbon::now()->format('d/m/Y')];
    }

    public function render()
    {
        $date = null;
        $dateRange = null;
        if (count($this->dateRange) == 2) {
            $dateRange  = [Carbon::createFromFormat('d/m/Y', $this->dateRange[0])->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $this->dateRange[1])->format('Y-m-d') ];
        } else {
            $date = [Carbon::createFromFormat('d/m/Y', $this->dateRange[0])->format('Y-m-d')];
        }

        $pernikahans    = ModelsPernikahan::with('penghulu', 'peristiwa_nikah', 'desa')
                            ->when($this->search, function($query){
                                $query
                                ->where(function($query){
                                    $query
                                    ->where('male', 'like',  '%'.$this->search.'%')
                                    ->orWhere('female', 'like',  '%'.$this->search.'%')
                                    ->orWhereHas('desa', function($query){
                                        $query->where('name', 'like', '%'. $this->search. '%');
                                    })
                                    ->orWhere('marriage_certificate_number', 'like',  '%'.$this->search.'%')
                                    ->orWhere('perforation_number', 'like',  '%'.$this->search.'%')
                                    ->orWhere('date_time', 'like',  '%'.$this->search.'%')
                                    ->orWhereHas('penghulu', function($query){
                                        $query->where('name', 'like', '%'. $this->search .'%');
                                    })
                                    ->orWhereHas('peristiwa_nikah', function($query){
                                        $query->where('name', 'like', '%'. $this->search .'%');
                                    });
                                });
                            })
                            ->when($dateRange, function($query, $dateRange) {
                                $query->whereBetween('date_time', $dateRange);
                            })
                            ->when($date, fn($q)=> $q->whereDate('date_time', $date))
                            ->when($this->filterAge, function($query){
                                $query
                                ->where(function($query){
                                    switch ($this->filterAge) {
                                        case 'p<19':
                                            $query->where([
                                                ['male_age', '<', 19],
                                            ]);
                                            break;
                                        case 'p>=19&&<=21':
                                            $query->where([
                                                ['male_age', '>=', 19],
                                                ['male_age', '<=', 21],
                                            ]);
                                            break;
                                        case 'p>21':
                                            $query->where([
                                                ['male_age', '>', 21],
                                            ]);
                                            break;
                                        case 'w<19':
                                            $query->where([
                                                ['female_age', '<', 19],
                                            ]);
                                            break;
                                        case 'w>=19&&<=21':
                                            $query->where([
                                                ['female_age', '>=', 19],
                                                ['female_age', '<=', 21],
                                            ]);
                                            break;
                                        case 'w>21':
                                            $query->where([
                                                ['female_age', '>', 21],
                                            ]);
                                            break;
                                    }
                                });
                            })
                            ->where('kua_id', auth()->user()->kua_id)
                            ->latest()
                            ->paginate(10);
        return view('livewire.pernikahan.pernikahan', compact('pernikahans'));
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }
}
