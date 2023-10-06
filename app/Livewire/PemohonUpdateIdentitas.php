<?php

namespace App\Livewire;

use App\Models\File;
use App\Models\Pemohon;
use Livewire\Component;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Livewire\WithFileUploads;

class PemohonUpdateIdentitas extends Component
{
    use WithFileUploads;

    public $nama;
    public $nohp;
    public $alamat;
    public $jenis;
    public $berkasKtp;

    private $_title;

    public $redirectTo = null;

    public function mount($redirectTo = null)
    {
        $this->redirectTo = $redirectTo;
        $this->nama = \Auth::user()->name;
        if ($me = Pemohon::me()) {
            $this->nohp = $me->nohp;
            $this->alamat = $me->alamat;
        }

    }

    public function updatedBerkasKtp()
    {
        $this->validate(
            ['berkasKtp' => 'image|max:3072']
        );
    }


    public function render()
    {
        return view('livewire.pemohon-update-identitas', [
            'me' => Pemohon::me(),
            'fileConfig' => ['mimes' => 'png,jpg,jpeg', 'maxSize' => 3072]
        ])
            ->title('Update Identitas');
    }

    public function save()
    {
        $me = Pemohon::me();
        $this->validate([
            'nama' => ['required', 'string'],
            'nohp' => ['required', 'string'],
            'alamat' => ['required', 'string'],
            'berkasKtp' => [$me && $me->ktp ? 'nullable' : 'required', 'image', 'max:3072']
        ]);
        $dataPemohon = $this->only(['nohp', 'alamat']);
        if (!$me) {
            $me = Pemohon::create(array_merge($dataPemohon, ['user_id' => auth()->id()]));
        } else {
            $me->update($dataPemohon);
        }

        if ($this->berkasKtp) {
            if ($me->ktp) {
                $me->ktp->delete();
            }
            /** @var TemporaryUploadedFile $fileUpload */
            $fileUpload = $this->berkasKtp;
            if ($path = $fileUpload->store('public/ktp')) {
                $me->ktp()->create([
                    'path' => $path,
                    'name' => $fileUpload->getClientOriginalName(),
                    'key' => File::KEY_KTP,
                ]);
            }
        }

        session()->flash('status', 'Data identitas berhasil diupdate.');
        if ($this->redirectTo) {
            $this->redirect($this->redirectTo, true);
        }
    }
}
