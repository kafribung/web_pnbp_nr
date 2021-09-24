<?php

namespace App\Http\Livewire\StafKua;

use App\Models\User;
use Livewire\{Component, WithPagination};

class StafKua extends Component
{
    use WithPagination;

    public $search;
    public $modal = false;

    protected $paginationTheme = 'costume';

    public function render()
    {
        $stafKuas = User::with('roles', 'kua')
        ->when($this->search, function($query){
            $query->where('name', 'like', '%'.$this->search.'%')
            ->orWhere('email', 'like', '%'.$this->search.'%')
            ->orWhereHas('kua', function($query) {
                $query->where('name', 'like', '%'.$this->search.'%');
            });
        })
        ->whereHas('roles', function($query) {
            $query->where('name', 'staf');
        })
        ->latest()->paginate(10);

        return view('livewire.staf-kua.staf-kua', compact('stafKuas'));
    }

    public function openCloseModal()
    {
        $this->modal = !$this->modal;
    }
}
