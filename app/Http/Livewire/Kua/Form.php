<?php
namespace App\Http\Livewire\Kua;

use App\Models\Kua as KuaModel;

class Form extends Kua
{
    public $name, $kuaId, $kuaIdDelete;

    protected $listeners =[
        'create',
        'edit',
        'delete'
    ];

    protected $rules =[
        'name' => ['required', 'string', 'min:3'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        return view('livewire.kua.form');
    }

    public function create()
    {
        $this->openCloseModal();
    }

    public function storeOrUpdate()
    {
        $data = $this->validate();
        $data['created_by'] = auth()->user()->id;

        KuaModel::updateOrCreate(['id' => $this->kuaId], $data);

        session()->flash('message', $this->kuaId ? 'Data KUA ' . $this->name. ' berhasil diubah' : 'Data KUA berhasil ditambhakan');
        $this->fieldsReset();
        $this->openCloseModal();
        return redirect('kua');
    }

    public function edit($id)
    {
        $this->kuaId= $id;
        $kua        = KuaModel::findOrFail($id);
        $this->name = $kua->name;
        $this->openCloseModal();
    }

    public function delete($id)
    {
        $this->kuaIdDelete = $id;
        $this->openCloseModal();
    }

    public function destroy()
    {
        $kua = KuaModel::findOrFail($this->kuaIdDelete);
        $kua->delete();
        session()->flash('message', 'Data KUA ' . $kua->name .' berhasil dihapus');
        $this->fieldsReset();
        $this->openCloseModal();
        return redirect('kua');
    }

    public function fieldsReset()
    {
        $this->name        = '';
        $this->kuaId       = '';
        $this->kuaIdDelete = '';
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->fieldsReset();
    }
}
