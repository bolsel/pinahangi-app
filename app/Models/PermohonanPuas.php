<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PermohonanPuas extends Model
{
    protected $table = 'permohonan_puas';
    protected $fillable = [
        'puas',
        'keterangan',
        'permohonan_id'
    ];
    protected $casts = [
        'puas' => 'bool'
    ];

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class);
    }
}
