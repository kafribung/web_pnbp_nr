<?php

namespace App\Http\Livewire\Pernikahan;

use App\Models\{Kua, Role, User};
use Illuminate\Support\Facades\Http;

class Form extends Pernikahan
{
    public $male,
        $female,
        $male_age,
        $female_ag,
        $village,
        $pernikahanId,
        $pernikahanIdDelete;

    protected $listeners = [
        'create',
        'edit',
        'delete',
    ];

    // protected function  rules()
    // {
    //     return [
    //         'name'     => 'required|string|min:3',
    //         'email'    => ['required', 'string', 'email', 'unique:users,email, '. $this->pernikahanId],
    //         'password' => ['required', 'confirmed', 'max:8' ],
    //         'kua_id'   => ['required', 'numeric'],
    //     ];
    // }

    // public function updated($propertyName)
    // {
    //     $this->validateOnly($propertyName);
    // }

    public function render()
    {
        $villages = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604030');
        $villages = $villages->json();

        // dd($villages);

        return view('livewire.pernikahan.form', compact('villages'));
    }

    public function create()
    {
        $this->openCloseModal();
    }

    public function storeOrUpdate()
    {
        $data = $this->validate();
        $data['password'] = bcrypt($this->password);

        $stafKua = User::updateOrcreate(['id' => $this->pernikahanId], $data);
        $role_id = Role::where('name', 'staf')->first()->id;
        $stafKua->roles()->sync([$role_id]);

        session()->flash('message', $this->pernikahanId ? 'Data staf KUA ' . $this->name. ' berhasil diubah' : 'Data staf KUA berhasil ditambhakan');
        $this->closeModal();
        return redirect('staf-kua');
    }

    public function edit($id)
    {
        $this->pernikahanId = $id;
        $stafKua      = User::findOrFail($id);
        $this->name   = $stafKua->name;
        $this->email  = $stafKua->email;
        $this->kua_id = $stafKua->kua_id;
        $this->openCloseModal();
    }

    public function delete($id)
    {
        $this->pernikahanIdDelete = $id;
        $stafKua      = User::findOrFail($id);
        $this->name   = $stafKua->name;
        $this->openCloseModal();
    }

    public function destroy()
    {
        $stafKua = User::findOrFail($this->pernikahanIdDelete);

        $stafKua->delete();

        session()->flash('message', 'Data staf KUA ' . $stafKua->name .' berhasil dihapus');
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
        $this->pernikahanId                = '';
        $this->pernikahanIdDelete          = '';
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->fieldsReset();
    }
}
