<?php

namespace App\Http\Livewire\Pernikahan;

use App\Models\Pernikahan as ModelsPernikahan;
use Livewire\Component;

class Pernikahan extends Component
{
    public $modal= false;
    public function render()
    {
        $pernikahans = ModelsPernikahan::with('penghulu')->paginate(10);
        return view('livewire.pernikahan.pernikahan', compact('pernikahans'));
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }
}
