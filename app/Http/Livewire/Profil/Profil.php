<?php

namespace App\Http\Livewire\Profil;

use App\Rules\MatchOldPasswordRule;
use Livewire\Component;
use Illuminate\Validation\Rules;


class Profil extends Component
{
    public $modal = true,
            $name,
            $password_old,
            $password,
            $password_confirmation;

    public function rules()
    {
        return [
            'name'         => 'required|min:3|string',
            'password_old' => ['required', new MatchOldPasswordRule],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
        ];
    }

    public function updated($propertyName)
    {
        $this->validateOnly($propertyName);
    }

    public function mount()
    {
        $this->name = auth()->user()->name;
    }

    public function render()
    {
        return view('livewire.profil.form');
    }

    public function update()
    {
        $data = $this->validate();

        $data['password'] = bcrypt($this->password);

        auth()->user()->update($data);

        session()->flash('status', 'Profil berhasil diperbaruhi, silahkan login ulang');
        auth()->logout();
        return redirect('login');
    }

    public function closeModal()
    {
        return redirect('dashboard');
    }
}
