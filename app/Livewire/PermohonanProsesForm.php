<?php

namespace App\Livewire;

use App\Jobs\PermohonanJob;
use App\Models\File;
use App\Models\Permohonan;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PermohonanProsesForm extends Component
{
    use WithFileUploads;

    public Permohonan $permohonan;
    public $informasi;
    public $dataKeys = ['default'];
    public $data = [];

    public function mount(Permohonan $permohonan)
    {
        $this->permohonan = $permohonan;
        $this->informasi = $permohonan->informasi;
    }

    public function render()
    {
        return view('livewire.permohonan-proses-form');
    }

    public function addDataKeys()
    {
        $this->dataKeys[] = \Str::random(6);
    }

    public function hapusDataFile($id)
    {
        $this->permohonan->dataFiles()->where('id', $id)->delete();
    }

    public function save()
    {
        $this->validate([
            'informasi' => 'nullable|string',
            'data.*' => 'file|mimes:jpg,png,pdf|max:10485'
        ]);
        /**
         * @var $file TemporaryUploadedFile
         */
        foreach ($this->data as $file) {
            if ($path = $file->store('public/permohonan-jenis-pemohon')) {
                $this->permohonan->dataFiles()->create([
                    'path' => $path,
                    'name' => $file->getClientOriginalName(),
                    'key' => File::KEY_PERMOHONAN_DATA,
                ]);
            }
        }
        if ($this->permohonan->isPerbaiki()) {
            if ($this->permohonan->update(['status' => Permohonan::STATUS_SELESAI, 'informasi' => $this->informasi])) {
                $this->permohonan->log()->create(['status' => Permohonan::STATUS_SELESAI]);
                PermohonanJob::dispatch($this->permohonan);
            }
        } else {
            if ($this->permohonan->update(['status' => Permohonan::STATUS_TELAAH, 'informasi' => $this->informasi])) {
                $this->permohonan->log()->create(['status' => Permohonan::STATUS_TELAAH]);
                PermohonanJob::dispatch($this->permohonan);
            }
        }

        session()->flash('global-info', 'Permohonan telah diproses.');
        $this->redirect(route('app.permohonan.proses-list'), true);
    }
}
