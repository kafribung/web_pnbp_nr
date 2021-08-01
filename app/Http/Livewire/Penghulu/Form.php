<?php

namespace App\Http\Livewire\Penghulu;

use App\Models\{Golongan, Kua, Penghulu as PenghuluModel};

class Form extends Penghulu
{
    public $name, $kua_id, $golongan_id, $penghuluId, $penghuluDeleteId;

    protected $listeners = [
        'create',
        'edit',
        'delete',
    ];

    protected $rules = [
        'name'        => 'required|string|min:3',
        'golongan_id' => 'required',
        'kua_id'      => 'required',
    ];

    public function render()
    {
        $golongans = Golongan::get(['id', 'name']);
        $kuas      = Kua::get(['id', 'name']);
        return view('livewire.penghulu.form', compact('golongans', 'kuas'));
    }

    public function create()
    {
        $this->openCloseModal();
    }

    public function storeOrUpdate()
    {
        $data = $this->validate();
        $data['created_by'] = auth()->user()->id;

        PenghuluModel::updateOrCreate(['id', $this->penghuluId], $data);

        session()->flash('message', $this->penghuluId ? 'Data penghulu ' . $this->name. ' berhasil diubah' : 'Data penghulu berhasil ditambhakan');
        $this->fieldsReset();
        $this->openCloseModal();
        return redirect('penghulu');
    }

    public function fieldsReset()
    {
        $this->name             = '';
        $this->kuaId            = '';
        $this->golongan_id      = '';
        $this->penghuluId       = '';
        $this->penghuluDeleteId = '';
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->fieldsReset();
    }
}
