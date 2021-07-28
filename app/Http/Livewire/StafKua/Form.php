<?php

namespace App\Http\Livewire\StafKua;

use App\Models\Kua;

class Form extends StafKua
{
    public $name, $email, $password, $kua, $stafId;

    protected $listeners = [
        'create',
        'edit',
        'delete',
    ];

    protected $rules = [
        'name' => 'required',
    ];

    public function render()
    {
        $kuas = Kua::get(['id', 'name']);
        return view('livewire.staf-kua.form', compact('kuas'));
    }

    public function create()
    {
        $this->openCloseModal();
    }

    public function storeOrUpdate()
    {

    }

    public function fieldsReset()
    {
        $this->name        = '';
        $this->email       = '';
        $this->password    = '';
        $this->kua    = '';
        $this->stafId      = '';
    }


    public function closeModal()
    {
        $this->modal = false;
        $this->fieldsReset();
    }
}
