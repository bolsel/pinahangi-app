<?php

namespace App\Livewire;

use App\Jobs\PermohonanJob;
use App\Models\File;
use App\Models\Pemohon;
use App\Models\Permohonan;
use App\Models\User;
use App\Notifications\PermohonanNotification;
use Carbon\Carbon;
use Illuminate\Validation\Rule;
use Livewire\Attributes\Title;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PermohonanBaru extends Component
{
    use WithFileUploads;

    public $id;
    public $status;
    public $jenis_pemohon = Pemohon::JENIS_PERORANGAN;
    public $berkasJenis;
    public $data = [];
    public $permohonan;

    public function mount()
    {
        $me = Pemohon::me();
        abort_if($me->permohonanAktif, 404);
        if ($permohonan = $me->permohonanKonsepValidasi) {
            $this->fill($permohonan);
        }
    }

    public function updatedBerkas()
    {
        $this->validate(
            ['berkasJenis' => 'file|mimes:jpg,png,jpeg,pdf|max:3072']
        );
    }

    public function updatedJenisPemohon()
    {
        if ($this->jenis_pemohon === Pemohon::JENIS_PERORANGAN && $this->berkasJenis) {
            $this->berkasJenis = null;
        }

    }

    #[Title('Permohonan Baru')]
    public function render()
    {
        return view('livewire.permohonan-baru', [
            'me' => Pemohon::me(),
            'currentPermohonan' => $this->id ? Permohonan::find($this->id) : null
        ]);
    }

    public function updateFormulir()
    {
        if ($this->id) {
            Permohonan::find($this->id)->update(['status' => Permohonan::STATUS_KONSEP]);
            $this->status = Permohonan::STATUS_KONSEP;
        }

    }

    public function save()
    {
        $permohonan = $this->id ? Permohonan::findOrFail($this->id) : null;
        $rules = [
            'jenis_pemohon' => ['required', Rule::in(array_keys(Pemohon::JENIS))],
            'permohonan' => 'required',
            'berkasJenis' => (!$permohonan && $this->jenis_pemohon !== Pemohon::JENIS_PERORANGAN) ||
            ($permohonan && $this->jenis_pemohon !== Pemohon::JENIS_PERORANGAN && !$permohonan->berkasJenis)
                ?
                'required|file|mimes:jpg,png,jpeg,pdf|max:3072' : 'nullable'
        ];
        if ($this->jenis_pemohon !== Pemohon::JENIS_PERORANGAN) {
            foreach (Permohonan::dataPemohonJenisConfig($this->jenis_pemohon) as $_name => $conf) {
                if ($conf['required']) {
                    $rules['data.' . $_name] = 'required';
                }
            }
        }

        $this->validate($rules);
        if ($this->jenis_pemohon === Pemohon::JENIS_PERORANGAN) {
            $this->data = [];
        }
        $permohonanData = [
            'jenis_pemohon' => $this->jenis_pemohon,
            'permohonan' => $this->permohonan,
            'pemohon_id' => Pemohon::me()->id,
            'data' => $this->data
        ];

        if ($permohonan) {
            $permohonan->update($permohonanData);
        } else {
            $permohonan = Permohonan::create([
                'jenis_pemohon' => $this->jenis_pemohon,
                'permohonan' => $this->permohonan,
                'pemohon_id' => Pemohon::me()->id,
                'data' => $this->data
            ]);
            $permohonan->log()->create(['status' => Permohonan::STATUS_KONSEP]);
        }
        if ($this->jenis_pemohon === Pemohon::JENIS_PERORANGAN && $permohonan->berkasJenis) {
            $permohonan->berkasJenis->delete();
        }
        if ($this->berkasJenis) {
            if ($permohonan->berkasJenis) {
                $permohonan->berkasJenis->delete();
            }
            /** @var TemporaryUploadedFile $fileUpload */
            $fileUpload = $this->berkasJenis;
            if ($path = $fileUpload->store('public/permohonan-jenis-pemohon')) {
                $permohonan->berkasJenis()->create([
                    'path' => $path,
                    'name' => $fileUpload->getClientOriginalName(),
                    'key' => File::KEY_PERMOHONAN_JENIS_PEMOHON,
                ]);
            }
        }

        $permohonan->update(['status' => Permohonan::STATUS_VALIDASI]);
        $this->validasiLog($permohonan);

        $this->fill($permohonan);
    }

    public function send()
    {
        if ($this->id) {
            $permohonan = Permohonan::findOrFail($this->id);
            $permohonan->update([
                'status' => Permohonan::STATUS_VERIFIKASI
            ]);
            $this->validasiLog($permohonan);
            $permohonan->log()->create([
                'status' => Permohonan::STATUS_VERIFIKASI,
                'waktu' => now()->add('10s')
            ]);
            PermohonanJob::dispatch($permohonan);
            session()->flash('global-info', 'Permohonan Informasi telah terkirim dan akan segera diverifikasi.');
            $this->redirect(route('app.permohonan.index'), true);
        }
    }

    protected function validasiLog(Permohonan $permohonan)
    {
        if ($validasiLog = $permohonan->log()->where('status', Permohonan::STATUS_VALIDASI)->first()) {
            $validasiLog->update(['waktu' => now()]);
        } else {
            $permohonan->log()->create(['status' => Permohonan::STATUS_VALIDASI]);
        }
    }
}
