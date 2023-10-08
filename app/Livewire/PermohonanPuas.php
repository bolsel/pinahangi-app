<?php

namespace App\Livewire;

use App\Models\Permohonan;
use Illuminate\Validation\Rule;
use Livewire\Component;

class PermohonanPuas extends Component
{
    public Permohonan $permohonan;
    public $puas;
    public $keterangan;

    public function mount(Permohonan $permohonan)
    {
        $this->permohonan = $permohonan;
    }

    public function setPuas($val)
    {
        $this->puas = $val;

    }

    public function render()
    {
        return view('livewire.permohonan-puas');
    }

    public function send()
    {
        $this->validate([
            'puas' => ['required', 'bool'],
            'keterangan' => [Rule::requiredIf($this->puas === false)],
        ]);

        $this->permohonan->kepuasan()->updateOrCreate([
            'permohonan_id' => $this->permohonan->id
        ], [
            'puas' => $this->puas,
            'keterangan' => $this->keterangan
        ]);
    }
}
