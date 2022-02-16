<?php

namespace App\Http\Livewire\Pernikahan;



use Livewire\Component;
use App\Models\Pernikahan;

class FormRepair extends Component
{

    public $modal = false,
            $note,
            $pernikahan;

    protected $listeners = [
        'edit'
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
        $this->modal      = true;
        $this->pernikahan = Pernikahan::find($id);

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

        return redirect('pernikahan');
    }

    public function closeModal()
    {
        $this->modal = false;
        $this->note  = null;
    }

}
