<?php

namespace App\Livewire;

use App\Jobs\PermohonanJob;
use App\Models\Permohonan;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Component;

class PermohonanVerifikasiForm extends Component
{
    public Permohonan $permohonan;
    public $status_terima = Permohonan::STATUS_PROSES;
    public $status_tolak = Permohonan::STATUS_VERIFIKASI_TOLAK;
    public $status;
    public $organisasi_id;
    public $keterangan;

    public function mount(Permohonan $permohonan)
    {
        $this->permohonan = $permohonan;
    }

    public function send()
    {
        $this->validate([
            'status' => ['required', Rule::in([Permohonan::STATUS_PROSES, Permohonan::STATUS_VERIFIKASI_TOLAK])],
            'keterangan' => [Rule::requiredIf($this->status === Permohonan::STATUS_VERIFIKASI_TOLAK)],
            'organisasi_id' => [Rule::requiredIf($this->status === Permohonan::STATUS_PROSES)],
        ]);
        if ($this->permohonan->update([
            'status' => $this->status,
            'organisasi_id' => $this->organisasi_id,
        ])) {
            $this->permohonan->log()->create(['status' => $this->status, 'keterangan' => $this->keterangan]);
            PermohonanJob::dispatch($this->permohonan);
        }

        session()->flash('global-info', 'Permohonan telah diverifikasi.');
        $this->redirect(route('app.permohonan.verifikasi-list'), true);
    }

    public function render()
    {
        return view('livewire.permohonan-verifikasi-form');
    }
}
