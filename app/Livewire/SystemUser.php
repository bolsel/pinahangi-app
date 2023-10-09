<?php

namespace App\Livewire;

use App\Base\LivewireComponentData;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;
use Livewire\Component;

class SystemUser extends LivewireComponentData
{
    const ROLE_LIST = [
        User::ROLE_SU => 'Superuser',
        User::ROLE_VERIFIKASI => 'Verifikasi',
        User::ROLE_TELAAH => 'Telaah'
    ];
    public $model = User::class;

    protected function builder()
    {
        $q = User::query()->whereNotIn('role', [User::ROLE_USER, User::ROLE_ORGANISASI]);
        if ($this->search_query) {
            $q->where(function (Builder $query) {
                $query->where('name', 'like', '%' . $this->search_query . '%')
                    ->orWhere('email', 'like', '%' . $this->search_query . '%');
            });
        }
        $this->builderBuild($q);
        return $q;
    }

    #[Title('System User')]
    public function render()
    {
        return view('livewire.system-user', [
            'data' => $this->builder()->paginate(10)
        ]);
    }

}
