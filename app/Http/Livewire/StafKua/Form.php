<?php

namespace App\Http\Livewire\StafKua;

use App\Models\Kua;

class Form extends StafKua
{
    public $name, $email, $password, $stafId;

    protected $listeners = [
        'create',
        'edit',
        'delete',
    ];

    public function render()
    {
        // $kuas = Kua::get(['id', 'name']);
        return view('livewire.staf-kua.form');
    }

    public function create()
    {
        $this->openCloseModal();
    }

    public function fieldsReset()
    {
        $this->name        = '';
        $this->email       = '';
        $this->password    = '';
        $this->stafId      = '';
    }


    public function closeModal()
    {
        $this->modal = false;
        $this->fieldsReset();
    }
}
