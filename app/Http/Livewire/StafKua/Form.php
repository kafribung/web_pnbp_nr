<?php

namespace App\Http\Livewire\StafKua;

use App\Models\{Kua, Role, User};

class Form extends StafKua
{
    public $name, $email, $password, $password_confirmation, $kua_id, $stafId;

    protected $listeners = [
        'create',
        'edit',
        'delete',
    ];

    protected $rules = [
        'name'     => 'required|string',
        'email'    => ['required', 'string', 'email', 'unique:users,email, '. optional($this->stafId)->id],
        'password' => ['required', 'confirmed', 'max:8' ],
        'kua_id'   => ['required', 'numeric'],
    ];

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

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
        $data = $this->validate();
        $data['password'] = bcrypt($this->password);
        $data['password'] = bcrypt($this->password);

        $stafKua = User::updateOrcreate(['id' => $this->stafId], $data);
        $role_id = Role::where('name', 'staf')->first()->id;
        $stafKua->roles()->sync([$role_id]);

        session()->flash('message', $this->stafId ? 'Data Staf KUA ' . $this->name. ' berhasil diubah' : 'Data KUA berhasil ditambhakan');
        $this->closeModal();
        return redirect('staf-kua');
    }

    public function edit($id)
    {
        $this->stafId = $id;
        $staf         = User::findOrFail($id);
        $this->name   = $staf->name;
        $this->email  = $staf->email;
        $this->kua_id = $staf->kua_id;
        $this->openCloseModal();
    }

    public function fieldsReset()
    {
        $this->name        = '';
        $this->email       = '';
        $this->password    = '';
        $this->password_confirmation = '';
        $this->kua_od      = '';
        $this->stafId      = '';

    }

    public function closeModal()
    {
        $this->modal = false;
        $this->fieldsReset();
    }
}
