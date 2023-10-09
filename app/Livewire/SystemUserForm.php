<?php

namespace App\Livewire;

use App\Models\User;
use Illuminate\Validation\Rule;
use Livewire\Component;

class SystemUserForm extends Component
{
    public ?User $current = null;
    public $name;
    public $email;
    public $role;
    public $password;
    public $role_list = SystemUser::ROLE_LIST;

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
            'role' => ['required', Rule::in(array_keys($this->role_list))],
            'password' => [Rule::requiredIf(!$this->current)],
        ]);

        $data = $this->only(['name', 'email', 'role']);

        if ($this->password) {
            $data['password'] = $this->password;
        }
        if ($this->current) {
            $this->current->update($data);
        } else {
            User::create($data)->markEmailAsVerified();
        }
        session()->flash('status', 'User berhasil ' . ($this->current ? 'diupdate' : 'ditambahkan'));
        $this->redirect(route('app.users.index'), true);
    }

    public function render()
    {
        return view('livewire.system-user-form')
            ->title('System User (' . ($this->current ? 'Update' : 'Tambah') . ')');
    }
}
