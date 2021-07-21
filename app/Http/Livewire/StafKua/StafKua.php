<?php

namespace App\Http\Livewire\StafKua;

use App\Models\User;
use Livewire\Component;
use Livewire\WithPagination;

class StafKua extends Component
{
    use WithPagination;

    public $modal = false;

    public function render()
    {
        // $stafKuas = User::with('roles')->role(['kalukku', 'sampaga'])->get();
        // $stafKuas = User::with('roles')->paginate(1);
        $stafKuas = User::whereHas('roles', function($query) {
            $query->where('name','!=', 'admin');
        })->paginate(10);
        return view('livewire.staf-kua.staf-kua', compact('stafKuas'));
    }

    public function openCloseModal()
    {
        $this->modal = $this->modal;
    }

    public function paginationView()
    {
        return 'vendor.livewire.costume';
    }
}
