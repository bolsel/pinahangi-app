<?php

namespace App\Livewire;

use App\Base\LivewireComponentData;
use App\Models\Pemohon;
use App\Models\Permohonan;
use Illuminate\Database\Eloquent\Builder;
use Livewire\Component;

class PermohonanData extends LivewireComponentData
{
    protected function builder(): Builder
    {
        return Permohonan::query();
    }

    public function render()
    {
        $dataPerluVerifikasi = Permohonan::where(['status' => Permohonan::STATUS_VERIFIKASI]);
        return view('livewire.permohonan-data', array_merge($this->viewData(), [
            'dataPerluVerifikasi' => $dataPerluVerifikasi
        ]));
    }

}
