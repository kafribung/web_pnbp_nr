<?php

namespace App\Http\Livewire\Penghulu;

use Livewire\Component;
use App\Models\Penghulu as PenghuluModel;

class Penghulu extends Component
{
    public $modal = false;

    protected $paginationTheme = 'costume';

    public function render()
    {
        $penghulus = PenghuluModel::with('golongan', 'kua')->paginate(10);
        return view('livewire.penghulu.penghulu', compact('penghulus'));
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }
}
