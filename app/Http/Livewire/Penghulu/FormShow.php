<?php

namespace App\Http\Livewire\Penghulu;

use App\Models\{ Penghulu as PenghuluModel};

class FormShow extends Penghulu
{

    public  $penghuluIdShow,
            $penghulu;

    protected $listeners = [
        'show',
    ];

    public function mount(PenghuluModel $penghuluModel)
    {
        $this->penghulu = $penghuluModel;
    }

    public function render()
    {
        $this->authorize('viewAny', new PenghuluModel());
        return view('livewire.penghulu.form-show');
    }

    public function show($id)
    {
        $this->penghuluIdShow = $id;
        $this->penghulu = PenghuluModel::findOrFail($id);
        $this->modalShow = true;
    }

    public function fieldsReset()
    {
        $this->penghuluIdShow = null;
    }

    public function closeModal()
    {
        $this->modalShow    = false;
        $this->fieldsReset();
    }
}
