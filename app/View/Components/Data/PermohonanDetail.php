<?php

namespace App\View\Components\Data;

use App\Models\Pemohon;
use App\Models\Permohonan;
use Illuminate\View\Component;

class PermohonanDetail extends Component
{
    public Permohonan $permohonan;
    public Pemohon $pemohon;
    public $hides = [];

    public function __construct(Permohonan|int $permohonan, $hides = [])
    {
        $this->permohonan = is_int($permohonan) ? Permohonan::findOrFail($permohonan) : $permohonan;
        $this->pemohon = $this->permohonan->pemohon;
        $this->hides = $hides;


    }

    public function isHide($val)
    {
        return in_array($val, $this->hides);
    }

    public function render()
    {
        return view('components.data.permohonan-detail');
    }
}
