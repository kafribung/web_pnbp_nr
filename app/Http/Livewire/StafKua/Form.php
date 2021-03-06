<?php

namespace App\Http\Livewire\StafKua;

use App\Models\{Kua, Role, User};
use App\Rules\UcwordsNotUpperCaseRule;

class Form extends StafKua
{
    public $name, $email, $password, $password_confirmation, $kua_id, $stafId, $stafIdDelete ;

    protected $listeners = [
        'create',
        'edit',
        'delete',
    ];

    protected function  rules()
    {
        return [
            'name'     => ['required', 'string','min:3', new UcwordsNotUpperCaseRule],
            'email'    => ['required', 'string', 'email', 'unique:users,email, '. $this->stafId],
            'password' => ['required', 'confirmed', 'max:8' ],
            'kua_id'   => ['required', 'numeric'],
        ];
    }

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

        session()->flash('message', $this->stafId ? 'Data staf KUA ' . $this->name. ' berhasil diubah' : 'Data staf KUA '. $this->name. ' berhasil ditambahkan');
        $this->closeModal();
        return redirect('staf-kua');
    }

    public function edit($id)
    {
        $this->stafId = $id;
        $stafKua      = User::findOrFail($id);
        $this->name   = $stafKua->name;
        $this->email  = $stafKua->email;
        $this->kua_id = $stafKua->kua_id;
        $this->openCloseModal();
    }

    public function delete($id)
    {
        $this->stafIdDelete = $id;
        $stafKua      = User::findOrFail($id);
        $this->name   = $stafKua->name;
        $this->openCloseModal();
    }

    public function destroy()
    {
        $stafKua = User::withCount('pernikahans')->findOrFail($this->stafIdDelete);

        // Jika Staf KUA memiliki data pernikahan
        if ($stafKua->pernikahans_count > 0) {
            session()->flash('message', 'Data staf KUA ' .$stafKua->name. ' tidak dapat dihapus');
            $this->closeModal();
            return redirect('staf-kua');
        }

        $stafKua->delete();

        session()->flash('message', 'Data staf KUA ' .$stafKua->name. ' berhasil dihapus');
        $this->closeModal();
        return redirect('staf-kua');
    }

    public function fieldsReset()
    {
        $this->name                  = '';
        $this->email                 = '';
        $this->password              = '';
        $this->password_confirmation = '';
        $this->kua_id                = '';
        $this->stafId                = '';
        $this->stafIdDelete          = '';
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->fieldsReset();
    }
}
