<?php

namespace App\Http\Livewire\Penghulu;

use Livewire\Component;
use App\Models\Penghulu as PenghuluModel;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;


class Penghulu extends Component
{
    use AuthorizesRequests;

    public $search;
    public $modal = false;

    protected $paginationTheme = 'costume';

    public function render()
    {
        $this->authorize('viewAny', new PenghuluModel());

        $penghulus = PenghuluModel::with('golongan', 'kua')
        ->when($this->search, function($query){
            $query->where('name', 'like', '%'.$this->search.'%');
            $query->orWhereHas('golongan', function($query){
                $query->where('name', 'like', '%'.$this->search.'%');
            });
            $query->orWhereHas('kua', function($query){
                $query->where('name', 'like', '%'.$this->search.'%');
            });
        })
        ->latest()
        ->paginate(10);
        return view('livewire.penghulu.penghulu', compact('penghulus'));
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }
}
