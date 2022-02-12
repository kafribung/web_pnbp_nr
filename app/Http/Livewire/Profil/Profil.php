<?php

namespace App\Http\Livewire\Profil;

use Livewire\Component;

class Profil extends Component
{
    public $modal = true,
            $name;

    protected $rules = [
        'name' => 'required|min:3|string',
    ];

    public function render()
    {
        return view('livewire.profil.form');
    }

    public function update()
    {
        $data = $this->validate();

        auth()->user()->update($data);

        session()->flash('message', 'Profil berhasil diperbaruhi');
        return redirect('dashboard');
    }

    public function closeModal()
    {
        return redirect('dashboard');
    }
}
