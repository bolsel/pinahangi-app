<?php

namespace App\Livewire;

use Livewire\Attributes\Title;
use Livewire\Component;

class UserUpdatePasswordForm extends Component
{
    public $password_lama;
    public $password;
    public $password_confirmation;

    #[Title('Ganti Password')]
    public function render()
    {
        return view('livewire.user-update-password-form');
    }

    public function save()
    {
        $this->validate([
            'password_lama' => 'required|current_password',
            'password' => 'required|confirmed|min:8',
        ]);
        \Auth::user()->update(['password' => \Hash::make($this->password)]);
        session()->flash('global-info', 'Password anda telah diganti.');
        $this->redirect(route('app.update-password'));

    }
}
