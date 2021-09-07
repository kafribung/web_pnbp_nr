<?php

namespace App\Http\Livewire\Pernikahan;

use App\Models\{Penghulu, Pernikahan as ModelsPernikahan, PeristiwaNikah};
use Illuminate\Support\Facades\Http;

class Form extends Pernikahan
{
    public $male,
        $female,
        $male_age,
        $male_father,
        $female_father,
        $female_age,
        $village,
        $marriage_certificate_number,
        $perforation_number,
        $penghulu_id,
        $peristiwa_nikah_id,
        $date_time,
        $pernikahanId,
        $pernikahanIdDelete;

    protected $listeners = [
        'create',
        'edit',
        'delete',
    ];

    protected function  rules()
    {
        return [
            'male'                       => 'required|string|min:3',
            'male_age'                   => 'required|numeric|min:2',
            'male_father'                => 'required|string|min:3',
            'female'                     => 'required|string|min:3',
            'female_age'                 => 'required|numeric|min:2',
            'female_father'              => 'required|string|min:3',
            'village'                    => 'required|string',
            'marriage_certificate_number'=> ['required', 'string', 'min:14', 'unique:pernikahans,marriage_certificate_number'],
            'perforation_number'         => ['required', 'string', 'min:12', 'unique:pernikahans,perforation_number'],
            'penghulu_id'                => ['required', 'numeric'],
            'peristiwa_nikah_id'         => ['required', 'numeric'],
            'date_time'                  => ['required', 'date'],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

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
        $data               = $this->validate();
        $data['created_by'] = auth()->id();
        $data['kua_id']     = auth()->user()->kua_id;
        $data['male']       = $data['male']. ' Bin ' .$data['male_father'];
        $data['female']       = $data['female']. ' Binti ' .$data['female_father'];

        if ($this->pernikahanId) $data['updated_by'] = auth()->id();

        ModelsPernikahan::updateOrcreate(['id' => $this->pernikahanId], $data);

        session()->flash('message', $this->pernikahanId ? 'Data pernikahan ' .$this->male. ' berhasil diubah' : 'Data pernikahan '.$this->male.' berhasil ditambahkan');
        $this->closeModal();
        return redirect('pernikahan');
    }

    public function edit($id)
    {
        $this->pernikahanId = $id;
        $stafKua      = ModelsPernikahan::findOrFail($id);
        $this->name   = $stafKua->name;
        $this->email  = $stafKua->email;
        $this->kua_id = $stafKua->kua_id;
        $this->openCloseModal();
    }

    public function delete($id)
    {
        $this->pernikahanIdDelete = $id;
        $stafKua      = ModelsPernikahan::findOrFail($id);
        $this->name   = $stafKua->name;
        $this->openCloseModal();
    }

    public function destroy()
    {
        $stafKua = ModelsPernikahan::findOrFail($this->pernikahanIdDelete);

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
        $this->male_father                   = null;
        $this->female_father                 = null;
        $this->female_age                    = null;
        $this->village                       = null;
        $this->marriage_certificate_number   = null;
        $this->perforation_number            = null;
        $this->penghulu_id                   = null;
        $this->peristiwa_nikah_id            = null;
        $this->date_time                     = null;
        $this->pernikahanId                  = null;
        $this->pernikahanIdDelete            = null;
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->fieldsReset();
        $this->emit('refreshParent');
    }
}
