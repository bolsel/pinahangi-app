<?php

namespace App\Livewire;

use App\Jobs\PermohonanJob;
use App\Models\Permohonan;
use Illuminate\Validation\Rule;
use Livewire\Component;

class PermohonanTelaahForm extends Component
{
    public Permohonan $permohonan;
    public $status_terima = Permohonan::STATUS_SELESAI;
    public $status_tolak = Permohonan::STATUS_PERBAIKI;
    public $status;
    public $keterangan;

    public function mount(Permohonan $permohonan)
    {
        $this->permohonan = $permohonan;

    }


    public function send()
    {
        $this->validate([
            'status' => ['required', Rule::in([Permohonan::STATUS_SELESAI, Permohonan::STATUS_PERBAIKI])],
        ]);
        if ($this->permohonan->update([
            'status' => $this->status,
        ])) {
            $this->permohonan->log()->create(['status' => $this->status, 'keterangan' => $this->keterangan]);
            PermohonanJob::dispatch($this->permohonan);
        }
        session()->flash('global-info', 'Permohonan telah ditelaah.');
        $this->redirect(route('app.permohonan.telaah-list'), true);
    }

    public function render()
    {
        return view('livewire.permohonan-telaah-form');
    }
}
