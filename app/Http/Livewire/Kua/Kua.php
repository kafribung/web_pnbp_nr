<?php

namespace App\Http\Livewire\Kua;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kua as ModelsKua;

class Kua extends Component
{
    use WithPagination;

    public $search;
    public $modal = false;

    protected $paginationTheme = 'costume';

    public function render()
    {
        $kuas = ModelsKua::orderBy('id', 'desc')->where('name', 'like', '%'. $this->search .'%')->paginate(10);
        return view('livewire.kua.kua', compact('kuas'));
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }
}
