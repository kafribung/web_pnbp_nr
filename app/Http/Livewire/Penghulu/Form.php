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
        $this->authorize('viewAny', new PenghuluModel());

        $golongans = Golongan::get(['id', 'name']);
        $kuas      = Kua::get(['id', 'name']);
        return view('livewire.penghulu.form', compact('golongans', 'kuas'));
    }

    public function create()
    {
        $this->authorize('create', new PenghuluModel());

        $this->openCloseModal();
    }

    public function storeOrUpdate()
    {
        $data = $this->validate();
        $data['created_by'] = auth()->user()->id;

        $penghulu = PenghuluModel::updateOrCreate(['id' => $this->penghuluId], $data);

        $this->authorize('update', $penghulu);

        session()->flash('message', $this->penghuluId ? 'Data penghulu ' . $this->name. ' berhasil diubah' : 'Data penghulu '.$this->name.' berhasil ditambahkan');
        $this->closeModal();
        return redirect('penghulu');
    }

    public function edit($id)
    {
        $this->penghuluId = $id;
        $penghulu = PenghuluModel::findOrFail($id);

        $this->authorize('update', $penghulu);

        $this->name             = $penghulu->name;
        $this->kua_id           = $penghulu->kua_id;
        $this->golongan_id      = $penghulu->golongan_id;
        $this->openCloseModal();
    }

    public function delete($id)
    {
        $this->penghuluIdDelete = $id;
        $penghulu = PenghuluModel::findOrFail($id);

        $this->authorize('delete', $penghulu);

        $this->name             = $penghulu->name;
        $this->openCloseModal();
    }

    public function destroy()
    {
        $penghulu = PenghuluModel::findOrFail($this->penghuluIdDelete);

        $this->authorize('delete', $penghulu);

        $penghulu->delete();
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
