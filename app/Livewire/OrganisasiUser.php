<?php

namespace App\Livewire;

use App\Base\LivewireComponentData;
use App\Models\Organisasi;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;

class OrganisasiUser extends LivewireComponentData
{

    public $model = User::class;

    protected function builder()
    {
        $q = User::query()
            ->with('organisasi')
            ->where('role', User::ROLE_ORGANISASI);
        if ($this->search_query) {
            $q->where(function (Builder $query) {
                $query->where('name', 'like', '%' . $this->search_query . '%')
                    ->orWhere('email', 'like', '%' . $this->search_query . '%')
                    ->orWhereHas('organisasi', function (Builder $query) {
                        $query->where('nama', 'like', '%' . $this->search_query . '%');
                    });
            });
        }
        $this->builderBuild($q);
        return $q;
    }

    #[Title('Operator Organisasi')]
    public function render()
    {
        return view('livewire.organisasi-user', [
            'data' => $this->builder()->paginate(10)
        ]);
    }

}
