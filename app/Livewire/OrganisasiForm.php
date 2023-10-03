<?php

namespace App\Livewire;

use App\Base\LivewireComponentForm;
use App\Models\Organisasi;
use App\Models\Permohonan;

class OrganisasiForm extends LivewireComponentForm
{
    public $nama = '';
    public $alamat = '';
    public Organisasi|null $current = null;

    public function mount(int|null $id = null)
    {
        if ($id) {
            $this->current = Organisasi::findOrFail($id);
            $this->fill($this->current);
        }
    }

    public function save()
    {
        $validated = $this->validate([
            'nama' => 'required|min:3',
            'alamat' => 'string',
        ]);
        if ($this->current) {
            $this->current->update($validated);
            session()->flash('status', 'Item berhasil diupdate');
        } else {
            Organisasi::create($validated);
            session()->flash('status', 'Item berhasil ditambahkan');
        }
        $this->redirect(route('app.organisasi.index'), true);
    }

    public function render()
    {
        return view('livewire.organisasi-form')
            ->title('Organisasi (' . ($this->current ? 'Update' : 'Tambah') . ')');
    }
}
