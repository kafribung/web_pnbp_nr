<?php

namespace App\Http\Livewire\Penghulu;

use App\Models\{Golongan, Kua, Penghulu as PenghuluModel};

class Form extends Penghulu
{
    public $name, $kua_id, $golongan_id, $penghuluId, $penghuluIdDelete;

    protected $listeners = [
        'create',
        'edit',
        'delete',
    ];

    protected $rules = [
        'name'         => 'required|string|min:3',
        'golongan_id'  => 'required',
        'kua_id'       => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

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

        PenghuluModel::updateOrCreate(['id' => $this->penghuluId], $data);

        session()->flash('message', $this->penghuluId ? 'Data penghulu ' . $this->name. ' berhasil diubah' : 'Data penghulu '.$this->name.' berhasil ditambhakan');
        $this->closeModal();
        return redirect('penghulu');
    }

    public function edit($id)
    {
        $this->penghuluId = $id;
        $penghulu = PenghuluModel::findOrFail($id);

        $this->name             = $penghulu->name;
        $this->kua_id           = $penghulu->kua_id;
        $this->golongan_id      = $penghulu->golongan_id;
        $this->openCloseModal();
    }

    public function delete($id)
    {
        $this->penghuluIdDelete = $id;
        $this->openCloseModal();
    }

    public function destroy()
    {
        $penghulu = PenghuluModel::findOrFail($this->penghuluIdDelete);
        $penghulu->delete()
        ;
        session()->flash('message', 'Data penghulu ' . $penghulu->name .' berhasil dihapus');
        $this->closeModal();
        return redirect('penghulu');
    }

    public function fieldsReset()
    {
        $this->name             = '';
        $this->kua_id           = '';
        $this->golongan_id      = '';
        $this->penghuluId       = '';
        $this->penghuluIdDelete = '';
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->fieldsReset();
    }
}
