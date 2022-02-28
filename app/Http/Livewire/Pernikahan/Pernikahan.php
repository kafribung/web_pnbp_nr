<?php

namespace App\Http\Livewire\Pernikahan;


use Illuminate\Support\Carbon;
use Livewire\Component;
use App\Models\{
    Pernikahan as ModelsPernikahan,
    Kua,
};
use Livewire\WithPagination;

class Pernikahan extends Component
{
    use WithPagination;

    protected $paginationTheme = 'costume';

    public $modal= false,
            $search,
            $filterAge,
            $dateRange = [],
            $kuas,
            $filterKua = 1;

    // public function updatedDateRange() {
    //     $this->emit('updateKuaDate', $this->filterKua, $this->dateRange);
    // }

    // public function updatedFilterKua() {
    //     $this->emit('updateKuaDate', $this->filterKua, $this->dateRange);
    // }

    public function mount()
    {
        $this->dateRange = [Carbon::now()->firstOfMonth()->format('d/m/Y'), Carbon::now()->addDay()->format('d/m/Y')];
    }

    public function render()
    {
        $this->kuas      = Kua::get(['name', 'id']);
        $date            = null;
        $dateRange       = null;
        if (count($this->dateRange) == 2) {
            $dateRange  = [Carbon::createFromFormat('d/m/Y', $this->dateRange[0])->format('Y-m-d'), Carbon::createFromFormat('d/m/Y', $this->dateRange[1])->format('Y-m-d') ];
        } else {
            $date = [Carbon::createFromFormat('d/m/Y', $this->dateRange[0])->format('Y-m-d')];
        }

        if (!auth()->user()->kua_id) $filterKua = $this->filterKua;
        else $filterKua = auth()->user()->kua_id;

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
                            ->when($filterKua, function($q, $filterKua){
                                $q->where('kua_id', $filterKua);
                            })
                            ->latest()
                            ->paginate(10);
        return view('livewire.pernikahan.pernikahan', compact('pernikahans'));
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }

    public function isAdminBimas()
    {
        if (!auth()->user()->kua) {
            return redirect('pernikahan');
        }
    }

}
