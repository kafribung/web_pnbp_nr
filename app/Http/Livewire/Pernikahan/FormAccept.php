<?php

namespace App\Http\Livewire\Pernikahan;

use Illuminate\Support\Arr;
use Livewire\Component;

class FormAccept extends Component
{
    public $modal = false,
            $filterKua,
            $dateRange;

    protected $listeners = [
        'create',
        'updateKuaDate'
    ];

    public function updateKuaDate($filterKua, $dateRange)
    {
        $this->filterKua = $filterKua;
        $this->dateRange = $dateRange;
    }

    public function render()
    {
        return view('livewire.pernikahan.form-accept');
    }

    public function create()
    {
        $this->modal = true;
    }

    public function storeOrUpdate()
    {
        
    }

    public function closeModal()
    {
        $this->modal = false;
    }


}
