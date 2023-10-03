<?php

namespace App\Livewire;

use App\Models\Organisasi;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;
use Livewire\Component;

class OrganisasiUserForm extends Component
{
    public ?User $current = null;
    public $name;
    public $email;
    public $password;
    public $password_confirmation;
    public $organisasi_id;

    public function mount(?int $id = null)
    {
        if ($id) {
            $this->current = User::findOrFail($id);
            $this->fill($this->current);
        }

    }

    public function save()
    {
        $this->validate([
            'name' => ['required'],
            'email' => ['required', Rule::unique(User::class, 'email')->ignore($this->current ?? null)],
            'password' => [Rule::requiredIf(!$this->current)],
            'organisasi_id' => ['required', Rule::exists(Organisasi::class, 'id')]
        ]);

        $data = $this->only(['name', 'email', 'organisasi_id']);

        if ($this->password) {
            $data['password'] = $this->password;
        }
        $data['role'] = User::ROLE_ORGANISASI;
        if ($this->current) {
            $this->current->update($data);
        } else {
            User::create($data)->markEmailAsVerified();
        }
        session()->flash('status', 'User berhasil ' . ($this->current ? 'diupdate' : 'ditambahkan'));
        $this->redirect(route('app.organisasi.user'), true);
    }

    public function render()
    {
        return view('livewire.organisasi-user-form')
            ->title('Operator Organisasi (' . ($this->current ? 'Update' : 'Tambah') . ')');
    }
}
