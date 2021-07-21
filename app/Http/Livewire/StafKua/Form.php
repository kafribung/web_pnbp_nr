<?php

namespace App\Http\Livewire\StafKua;

use App\Models\User;

class Form extends StafKua
{
    public $name, $email, $password;

    public function render()
    {
        return view('livewire.staf-kua.form');
    }
}
