<?php

namespace App\Http\Livewire\Kua;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kua as ModelsKua;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;

class Kua extends Component
{
    use WithPagination, AuthorizesRequests;

    public $search;
    public $modal = false;

    protected $paginationTheme = 'costume';

    public function render()
    {

        $this->authorize('viewAny', new ModelsKua);

        $kuas = ModelsKua::when($this->search, function($query){
            $query->where('name', 'like', '%'.$this->search.'%')
            ->orWhereHas('typology', function($query){
                $query->where('name', 'like', '%'.$this->search.'%' );
            });
        })
        ->orderBy('id', 'desc')->paginate(10);

        return view('livewire.kua.kua', compact('kuas'));
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }
}
