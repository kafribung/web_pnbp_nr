<?php

namespace App\Http\Livewire\Penghulu;

use Livewire\WithFileUploads;
use App\Rules\UcwordsNotUpperCaseRule;
use Illuminate\Support\Facades\Storage;
use App\Models\{Golongan, Kua, Penghulu as PenghuluModel};

class Form extends Penghulu
{
    use WithFileUploads;

    public $name,
            $kua_id,
            $golongan_id,
            $penghuluId,
            $penghuluIdDelete,
            $kua_leader = 0,
            $ttd_digital,
            $penghuluIdShow,
            $penghulu;

    protected $listeners = [
        'create',
        'edit',
        'delete',
    ];

    public function rules() {
        return [
            'name'         => ['required','string','min:3', new UcwordsNotUpperCaseRule],
            'golongan_id'  => 'required',
            'kua_id'       => 'required',
            'kua_leader'   => '',
            'ttd_digital'  => !empty($this->ttd_digital) ? 'image|max:1024' : '',
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function render()
    {
        $this->authorize('viewAny', new PenghuluModel());

        $golongans = Golongan::get(['id', 'name']);
        $kuas      = Kua::get(['id', 'name']);
        return view('livewire.penghulu.form', compact('golongans', 'kuas'));
    }

    public function create()
    {
        $this->authorize('create', new PenghuluModel());

        $this->openCloseModal();
    }

    public function storeOrUpdate()
    {
        $data = $this->validate();
        $data['created_by'] = auth()->user()->id;

        // Set jasa profesi penguhulu
        if (Kua::findOrFail($data['kua_id'])->typology->name == 'A')
            $data['jasa_profesi'] = 125000;
        elseif (Kua::findOrFail($data['kua_id'])->typology->name == 'B')
            $data['jasa_profesi'] = 150000;
        elseif (Kua::findOrFail($data['kua_id'])->typology->name == 'C')
            $data['jasa_profesi'] = 175000;
        elseif (Kua::findOrFail($data['kua_id'])->typology->name == 'D1') {
            $data['jasa_profesi'] = 400000;
        } elseif (Kua::findOrFail($data['kua_id'])->typology->name == 'D2') {
            $data['jasa_profesi'] = 400000;
        }

        // Jika sebagai kepala KUA maka data TDD akan disimpan
        if ($this->kua_leader == true) {

            // Jika kepala KUA sudah ada
            if (!$this->penghuluId) {
                if (PenghuluModel::where('kua_id', $data['kua_id'])->where('kua_leader', 1)->count() == 1) {
                    session()->flash('message', 'Kepala KUA sudah ada');
                    return redirect('penghulu');
                }
            }

            // Jika diedit maka gambar yang lama akan dihapus
            if ($this->penghuluId) {
                $penghulu = PenghuluModel::find($this->penghuluId);
                Storage::delete($penghulu->ttd_digital);
            }

            $data['ttd_digital'] = $this->ttd_digital->storeAs('ttd_digitals', time() . '.' . $this->ttd_digital->extension(), 'public');
        }

        $penghulu = PenghuluModel::updateOrCreate(['id' => $this->penghuluId], $data);

        session()->flash('message', $this->penghuluId ? 'Data penghulu ' . $this->name. ' berhasil diubah' : 'Data penghulu '.$this->name.' berhasil ditambahkan');
        $this->closeModal();
        return redirect('penghulu');
    }

    public function edit($id)
    {
        $this->penghuluId = $id;
        $penghulu = PenghuluModel::findOrFail($id);

        $this->authorize('update', $penghulu);

        $this->name             = $penghulu->name;
        $this->kua_id           = $penghulu->kua_id;
        $this->golongan_id      = $penghulu->golongan_id;
        $this->kua_leader       = $penghulu->kua_leader;

        $this->openCloseModal();
    }

    public function delete($id)
    {
        $this->penghuluIdDelete = $id;
        $penghulu = PenghuluModel::findOrFail($id);

        if ($penghulu->ttd_digital) {
            Storage::delete($penghulu->ttd_digital);
        }

        $this->authorize('delete', $penghulu);

        $this->name             = $penghulu->name;
        $this->openCloseModal();
    }

    public function destroy()
    {
        $penghulu = PenghuluModel::withCount('pernikahans')->findOrFail($this->penghuluIdDelete);

        $this->authorize('delete', $penghulu);

        // Jika Penghulu memiliki data pernikahan
        if ($penghulu->pernikahans_count > 0) {
            session()->flash('message', 'Data penghulu ' . $penghulu->name .' tidak dapat dihapus');
            $this->closeModal();
            return redirect('penghulu');
        }

        $penghulu->delete();
        session()->flash('message', 'Data penghulu ' . $penghulu->name .' berhasil dihapus');
        $this->closeModal();
        return redirect('penghulu');
    }

    public function fieldsReset()
    {
        $this->name             = '';
        $this->kua_id           = '';
        $this->golongan_id      = '';
        $this->penghuluId       = '';
        $this->penghuluIdDelete = '';
        $this->kua_leader       = 0;
        $this->ttd_digital      = '';
    }

    public function closeModal()
    {
        $this->modal     = false;
        $this->fieldsReset();
    }
}
