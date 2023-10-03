<?php

namespace App\Livewire;

use App\Base\LivewireComponentData;
use App\Models\Organisasi;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Attributes\Title;

class OrganisasiData extends LivewireComponentData
{
    public $model = Organisasi::class;

    public $formRoute = 'app.organisasi.form';

    protected function builder()
    {
        $q = Organisasi::query();
        if ($this->search_query) {
            $q->where(function (Builder $query) {
                $query->where('nama', 'like', '%' . $this->search_query . '%');
            });
        }
        $this->builderBuild($q);
        return $q;
    }

    #[Title('Organisasi')]
    public function render()
    {
        return view('livewire.organisasi-data', [
            'data' => $this->builder()->paginate(10)
        ]);
    }

}
