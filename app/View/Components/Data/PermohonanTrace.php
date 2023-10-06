<?php

namespace App\View\Components\Data;

use App\Models\Permohonan;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class PermohonanTrace extends Component
{
    public function __construct(public Permohonan $permohonan)
    {
    }

    public function render(): View
    {
        return view('components.data.permohonan-trace');
    }
}
