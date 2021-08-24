<?php

namespace App\Http\Livewire\Pernikahan;

use App\Models\{Kua, Penghulu, Role, User, PeristiwaNikah};
use Illuminate\Support\Facades\Http;

class Form extends Pernikahan
{
    public $male,
        $female,
        $male_age,
        $female_ag,
        $village,
        $marriage_certificate_number,
        $perforation_number,
        $penghulu_id,
        $peristiwa_nikah_id,
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
        $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604030');
        $villages        = $villages->json();
        $peristiwaNikahs = PeristiwaNikah::get(['id', 'name']);
        $penghulus       = Penghulu::where('kua_id', auth()->user()->kua_id)->get(['id', 'name']);

        return view('livewire.pernikahan.form', compact(
            'villages',
            'peristiwaNikahs',
            'penghulus',
        ));
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
        $this->male                          = null;
        $this->female                        = null;
        $this->male_age                      = null;
        $this->female_ag                     = null;
        $this->village                       = null;
        $this->marriage_certificate_number   = null;
        $this->perforation_number            = null;
        $this->penghulu_id                   = null;
        $this->peristiwa_nikah_id            = null;
        $this->pernikahanId                  = null;
        $this->pernikahanIdDelete            = null;
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->fieldsReset();
    }
}
