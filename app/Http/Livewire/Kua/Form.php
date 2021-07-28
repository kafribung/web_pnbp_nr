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

    public function render()
    {
        return view('livewire.kua.form');
    }

    public function create()
    {
        $this->openCloseModal();
    }

    public function store()
    {
        $data = $this->validate();
        $data['created_by'] = auth()->user()->id;

        KuaModel::create($data);

        session()->flash('message', 'Data KUA berhasil ditambhakan');
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

    public function update()
    {
        $kua  = KuaModel::findOrFail($this->kuaId);
        $data = $this->validate();
        $data['updated_by'] = auth()->user()->id;

        $kua->update($data);

        session()->flash('message', 'Data KUA ' .$kua->name. ' berhasil diubah');
        $this->fieldsReset();
        $this->openCloseModal();
        return redirect('kua');
    }

    public function delete($id)
    {
        $this->kuaIdDelete = $id;
        $this->openCloseModal();
    }

    public function destroy()
    {
        dd('bela');
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
