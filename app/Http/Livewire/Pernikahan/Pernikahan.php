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
            $filterYear;

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
                                    });
                            })
                            ->when($this->filterYear, function($query){
                                $query->whereYear('created_at', $this->filterYear);
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
