<?php
namespace App\Http\Livewire\Kua;

use App\Models\{Kua as ModelsKua, Typology};
class Form extends Kua
{
    public $name, $typology_id, $kuaId, $kuaIdDelete;

    protected $listeners =[
        'create',
        'edit',
        'delete'
    ];

    protected $rules =[
        'name'        => ['required', 'string', 'min:3'],
        'typology_id'  => 'required',
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->authorize('viewAny', new ModelsKua);

        $typologies = Typology::get(['id', 'name']);
        return view('livewire.kua.form', compact('typologies'));
    }

    public function create()
    {
        $this->authorize('create', new ModelsKua);

        $this->openCloseModal();
    }

    public function storeOrUpdate()
    {

        $data = $this->validate();
        $data['created_by'] = auth()->user()->id;

        $kua = ModelsKua::updateOrCreate(['id' => $this->kuaId], $data);

        $this->authorize('update', $kua);

        session()->flash('message', $this->kuaId ? 'Data KUA ' . $this->name. ' berhasil diubah' : 'Data KUA '.$this->name.' berhasil ditambahkan');
        $this->closeModal();
        return redirect('kua');
    }

    public function edit($id)
    {

        $this->kuaId        = $id;
        $kua                = ModelsKua::findOrFail($id);

        $this->authorize('update', $kua);

        $this->name         = $kua->name;
        $this->typology_id  = $kua->typology_id;
        $this->openCloseModal();
    }

    public function delete($id)
    {
        $this->kuaIdDelete  = $id;
        $kua                = ModelsKua::findOrFail($id);

        $this->authorize('delete', $kua);

        $this->name         = $kua->name;
        $this->openCloseModal();
    }

    public function destroy()
    {
        $kua = ModelsKua::withCount('penghulus', 'desas')->findOrFail($this->kuaIdDelete);

        $this->authorize('delete', $kua);

        // Jika KUA memiliki penghulu
        if ($kua->penghulus_count > 0 || $kua->desas_count > 0) {
            session()->flash('message', 'Data KUA ' . $kua->name .' tidak dapat dihapus');
            $this->closeModal();
            return redirect('kua');
        }

        $kua->delete();
        session()->flash('message', 'Data KUA ' . $kua->name .' berhasil dihapus');
        $this->closeModal();
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
