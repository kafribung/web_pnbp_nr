<?php

namespace App\Http\Livewire\StafKua;

use App\Models\User;
use Livewire\{Component, WithPagination};

class StafKua extends Component
{
    use WithPagination;

    public $modal = false;

    protected $paginationTheme = 'costume';

    public function render()
    {
        $stafKuas = User::with('roles', 'kua')->whereHas('roles', function($query) {
            $query->where('name', 'staf');
        })->latest()->paginate(10);
        return view('livewire.staf-kua.staf-kua', compact('stafKuas'));
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }
}
