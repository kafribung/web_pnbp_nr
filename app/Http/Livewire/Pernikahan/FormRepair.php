<?php

namespace App\Http\Livewire\Pernikahan;



use Livewire\Component;
use App\Models\Pernikahan as ModelsPernikahan;

class FormRepair extends Component
{

    public $modal = false,
            $note,
            $pernikahan,
            $show = true;

    protected $listeners = [
        'edit',
        'showNoteRepair'
    ];

    protected $rules = [
        'note' => 'required|string',
    ];

    public function render()
    {
        return view('livewire.pernikahan.form-repair');
    }

    public function edit($id)
    {
        $this->openCloseModal();
        $this->pernikahan = ModelsPernikahan::find($id);

        if ($this->pernikahan->note) {
            $this->note = $this->pernikahan->note;
        }
    }

    public function repair()
    {
        $data = $this->validate();

        $pernikahan  = $this->pernikahan;

        $pernikahan->note    = $data['note'];
        $pernikahan->approve = 'repair';
        $pernikahan->save();

        session()->flash('message', 'Data pernikahan '. $pernikahan->male . ' telah diajukan perbaikan');
        $this->openCloseModal();

        return $this->emit('refreshParent');
    }

    public function showNoteRepair($id)
    {
        $this->show       = false;
        $this->modal      = true;
        $this->pernikahan = ModelsPernikahan::find($id);
        $this->note       = $this->pernikahan->note;
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
        $this->note  = null;
        $this->show  = true;
    }

}
