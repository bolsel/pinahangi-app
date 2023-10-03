<?php

namespace App\Livewire;

use App\Base\LivewireComponentData;
use App\Models\Pemohon;
use App\Models\User;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;

class PemohonData extends LivewireComponentData
{

    public $model = Pemohon::class;

    protected function builder()
    {
        $q = Pemohon::query()
            ->join('users as u', 'user_id', '=', 'u.id');
//            ->where('role', '=', User::ROLE_USER);
        if ($this->search_query) {
            $q->where(function (Builder $query) {
                $query->where('u.email', 'like', '%' . $this->search_query . '%')
                    ->orWhere('u.name', 'like', '%' . $this->search_query . '%');
            });
        }
        $this->builderBuild($q);

        return $q;
    }

    #[Title('Data Pemohon')]
    public function render()
    {
        return view('livewire.pemohon-data', [
            'data' => $this->builder()->paginate(10)
        ]);
    }

}
