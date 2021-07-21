<?php
namespace App\Http\Livewire\Kua;

use App\Models\Kua as KuaModel;

class Form extends Kua
{
    public $name;

    protected $listeners =[
        'create',
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

    public function fieldsReset()
    {
        $this->name = '';
    }
}
