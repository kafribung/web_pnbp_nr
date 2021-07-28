<?php

namespace App\Http\Livewire\StafKua;

use App\Models\User;
use Livewire\{Component, WithPagination};

class StafKua extends Component
{
    use WithPagination;

    public $modal = false;

    public function render()
    {
        $stafKuas = User::with('roles')->whereHas('roles', function($query) {
            $query->where('name', 'staf');
        })->paginate(10);
        return view('livewire.staf-kua.staf-kua', compact('stafKuas'));
        dd($stafKuas);
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }

    public function paginationView()
    {
        return 'vendor.livewire.costume';
    }
}
