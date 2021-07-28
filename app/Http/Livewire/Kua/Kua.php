<?php

namespace App\Http\Livewire\Kua;

use Livewire\Component;
use Livewire\WithPagination;
use App\Models\Kua as KuaModel;

class Kua extends Component
{
    use WithPagination;

    public $modal = false;

    public function render()
    {
        $kuas = KuaModel::paginate(10);
        return view('livewire.kua.kua', compact('kuas'));
    }

    public function paginationView()
    {
        return 'vendor.livewire.costume';
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }
}