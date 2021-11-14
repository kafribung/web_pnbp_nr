<?php

namespace App\Http\Livewire\Pernikahan;

use App\Models\{Penghulu, Pernikahan as ModelsPernikahan, PeristiwaNikah};
use App\Rules\UppercaseRule;
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
        $pernikahanIdDelete,
        $transport;

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
            'marriage_certificate_number'=> ['required', 'string', 'min:14', 'unique:pernikahans,marriage_certificate_number,'. $this->pernikahanId],
            'perforation_number'         => ['required', 'string', new UppercaseRule ,'min:12', 'unique:pernikahans,perforation_number,'. $this->pernikahanId],
            'penghulu_id'                => ['required', 'numeric'],
            'peristiwa_nikah_id'         => ['required', 'numeric'],
            'date_time'                  => ['required', 'date'],
            'transport'                  => (auth()->user()->kua->name == 'Tommo' || auth()->user()->kua->name == 'Tapalang Barat' || auth()->user()->kua->name == 'Bonehau' || auth()->user()->kua->name == 'Kalumpang' || auth()->user()->kua->name == 'Kepulauan Balabalakang') ? 'required|numeric' : '',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        if (auth()->user()->kua->name == 'Bonehau')
            $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604041');
        elseif(auth()->user()->kua->name == 'Kalukku')
            $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604030');
        elseif(auth()->user()->kua->name == 'Kalumpang')
            $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604040');
        elseif(auth()->user()->kua->name == 'Kepulauan Balabalakang')
            $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604023');
        elseif(auth()->user()->kua->name == 'Mamuju')
            $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604020');
        elseif(auth()->user()->kua->name == 'Papalang')
            $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604031');
        elseif(auth()->user()->kua->name == 'Sampaga')
            $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604032');
        elseif(auth()->user()->kua->name == 'Simboro dan Kepulauan')
            $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604022');
        elseif(auth()->user()->kua->name == 'Tapalang')
            $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604010');
        elseif(auth()->user()->kua->name == 'Tapalang Barat')
            $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604011');
        else
            $villages        = Http::get('https://dev.farizdotid.com/api/daerahindonesia/kelurahan?id_kecamatan=7604033');

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

        if ($this->pernikahanId) $data['updated_by'] = auth()->id();

        ModelsPernikahan::updateOrcreate(['id' => $this->pernikahanId], $data);

        session()->flash('message', $this->pernikahanId ? 'Data pernikahan ' .$this->male. ' berhasil diubah' : 'Data pernikahan '.$this->male.' berhasil ditambahkan');
        $this->closeModal();
        return redirect('pernikahan');
    }

    public function edit($id)
    {
        $this->pernikahanId                  = $id;
        $pernikahan                          = ModelsPernikahan::findOrFail($id);

        $this->male                          = $pernikahan->male;
        $this->female                        = $pernikahan->female;
        $this->male_age                      = $pernikahan->male_age;
        $this->male_father                   = $pernikahan->male_father;
        $this->female_father                 = $pernikahan->female_father;
        $this->female_age                    = $pernikahan->female_age;
        $this->village                       = $pernikahan->village;
        $this->marriage_certificate_number   = $pernikahan->marriage_certificate_number;
        $this->perforation_number            = $pernikahan->perforation_number;
        $this->penghulu_id                   = $pernikahan->penghulu_id;
        $this->peristiwa_nikah_id            = $pernikahan->peristiwa_nikah_id;
        $this->date_time                     = $pernikahan->date_time;

        $this->openCloseModal();
    }

    public function delete($id)
    {
        $this->pernikahanIdDelete = $id;

        $pernikahan      = ModelsPernikahan::findOrFail($id);
        $this->male      = $pernikahan->male;
        $this->openCloseModal();
    }

    public function destroy()
    {
        $pernikahan      = ModelsPernikahan::findOrFail($this->pernikahanIdDelete);
        $pernikahan->delete();

        session()->flash('message', 'Data pernikahan ' . $this->male .' berhasil dihapus');
        $this->closeModal();
        return redirect('pernikahan');
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
