<?php

namespace App\Http\Livewire\Pernikahan;

use Illuminate\Support\Str;
use App\Rules\UppercaseRule;
use App\Models\{Desa, Penghulu, Pernikahan as ModelsPernikahan, PeristiwaNikah};
use App\Rules\UcwordsNotUpperCaseRule;

class Form extends Pernikahan
{
    public $male,
        $female,
        $male_age,
        $male_father,
        $female_father,
        $female_age,
        $desa_id,
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
            'male'                       => ['required', 'string', 'min:3', new UcwordsNotUpperCaseRule],
            'male_age'                   => 'required|numeric|min:2',
            'male_father'                => ['required', 'string', 'min:3', new UcwordsNotUpperCaseRule],
            'female'                     => ['required', 'string', 'min:3', new UcwordsNotUpperCaseRule],
            'female_age'                 => 'required|numeric|min:2',
            'female_father'              => ['required', 'string', 'min:3', new UcwordsNotUpperCaseRule],
            'desa_id'                    => 'required|numeric',
            'marriage_certificate_number'=> ['required', 'string', new UppercaseRule, 'min:13', 'unique:pernikahans,marriage_certificate_number,'. $this->pernikahanId],
            'perforation_number'         => ['required', 'string', new UppercaseRule, 'min:12', 'unique:pernikahans,perforation_number,'. $this->pernikahanId],
            'penghulu_id'                => ['required', 'numeric'],
            'peristiwa_nikah_id'         => ['required', 'numeric'],
            'date_time'                  => ['required', 'date'],
            'transport'                  => (auth()->user()->kua->name == 'Tommo' || auth()->user()->kua->name == 'Tapalang Barat' || auth()->user()->kua->name == 'Bonehau' || auth()->user()->kua->name == 'Kalumpang' || auth()->user()->kua->name == 'Kepulauan Balabalakang') ? 'required|numeric|' : '',
        ];
    }


    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $desas           = Desa::where('kua_id', auth()->user()->kua_id)->get();
        $peristiwaNikahs = PeristiwaNikah::get(['id', 'name']);
        $penghulus       = Penghulu::where('kua_id', auth()->user()->kua_id)->get(['id', 'name']);

        return view('livewire.pernikahan.form', compact(
            'desas',
            'peristiwaNikahs',
            'penghulus',
        ));
    }

    public function create()
    {
        $this->isAdminBimas();
        $this->openCloseModal();
    }

    public function storeOrUpdate()
    {
        if(auth()->user()->kua->name == 'Tommo'|| auth()->user()->kua->name == 'Tapalang Barat' || auth()->user()->kua->name == 'Bonehau'|| auth()->user()->kua->name == 'Kalumpang'){
            if ($this->transport > 750000) {
                session()->flash('error','Estimasi transport tidak boleh lebih dari 750.000');
                return redirect('pernikahan');
            }
        }

        if (auth()->user()->kua->name == 'Kepulauan Balabalakang') {
            if ($this->transport > 1000000) {
                session()->flash('error', 'Estimasi transport tidak boleh lebih dari 1.000.000');
                return redirect('pernikahan');
            }
        }

        $data               = $this->validate();
        $data['created_by'] = auth()->id();
        $data['kua_id']     = auth()->user()->kua_id;

        if ($this->pernikahanId) $data['updated_by'] = auth()->id();

        // Costume biaya transport jika login sebagai KUA tipologi DI dan D2
        if (auth()->user()->kua->name == 'Tommo' || auth()->user()->kua->name == 'Tapalang Barat' || auth()->user()->kua->name == 'Bonehau' || auth()->user()->kua->name == 'Kalumpang' || auth()->user()->kua->name == 'Kepulauan Balabalakang')
            $data['transport'] = $this->transport;
        else  $data['transport'] = 100000;

        ModelsPernikahan::updateOrcreate(['id' => $this->pernikahanId], $data);

        session()->flash('message', $this->pernikahanId ? 'Data pernikahan ' .$this->male. ' berhasil diubah' : 'Data pernikahan '.$this->male.' berhasil ditambahkan');
        $this->closeModal();
        return redirect('pernikahan');
    }

    public function edit($id)
    {
        $this->isAdminBimas();

        $this->pernikahanId                  = $id;
        $pernikahan                          = ModelsPernikahan::findOrFail($id);

        $this->male                          = $pernikahan->male;
        $this->female                        = $pernikahan->female;
        $this->male_age                      = $pernikahan->male_age;
        $this->male_father                   = $pernikahan->male_father;
        $this->female_father                 = $pernikahan->female_father;
        $this->female_age                    = $pernikahan->female_age;
        $this->desa_id                       = $pernikahan->desa_id;
        $this->marriage_certificate_number   = $pernikahan->marriage_certificate_number;
        $this->perforation_number            = $pernikahan->perforation_number;
        $this->penghulu_id                   = $pernikahan->penghulu_id;
        $this->peristiwa_nikah_id            = $pernikahan->peristiwa_nikah_id;
        $this->date_time                     = $pernikahan->date_time;
        $this->transport                     = $pernikahan->transport;

        $this->openCloseModal();
    }

    public function delete($id)
    {
        $this->isAdminBimas();
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
        $this->desa_id                       = null;
        $this->marriage_certificate_number   = null;
        $this->perforation_number            = null;
        $this->penghulu_id                   = null;
        $this->peristiwa_nikah_id            = null;
        $this->date_time                     = null;
        $this->transport                     = null;
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
