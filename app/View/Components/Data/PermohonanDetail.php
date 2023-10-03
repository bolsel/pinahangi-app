<?php

namespace App\View\Components\Data;

use App\Models\Permohonan;
use Illuminate\View\Component;

class PermohonanDetail extends Component
{
    public Permohonan $permohonan;
    public bool $withWaktuPermohonan = false;
    public bool $withWaktuVerifikasi = false;

    public function __construct(Permohonan|int $permohonan, $withWaktuPermohonan = false, $withWaktuVerifikasi = false)
    {
        $this->permohonan = is_int($permohonan) ? Permohonan::findOrFail($permohonan) : $permohonan;
        $this->withWaktuPermohonan = $withWaktuPermohonan;
        $this->withWaktuVerifikasi = $withWaktuVerifikasi;
    }

    public function render()
    {
        return view('components.data.permohonan-detail');
    }
}
