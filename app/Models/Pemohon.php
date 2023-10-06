<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Pemohon extends Model
{
    use HasFactory;

    const JENIS_PERORANGAN = 'perorangan';
    const JENIS_BADAN_HUKUM = 'badanhukum';
    const JENIS_KELOMPOK = 'kelompok';
    const JENIS = [
        self::JENIS_PERORANGAN => 'Perorangan',
        self::JENIS_BADAN_HUKUM => 'Badan Hukum',
        self::JENIS_KELOMPOK => 'Kelompok Orang / Organisasi Kemasyarakatan'
    ];

    protected $table = 'pemohon';
    protected $fillable = [
        'alamat', 'nohp', 'data', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }


    public static function me()
    {
        if (!\Auth::user()) return null;
        if (!\Auth::user()->roleIsUser()) return null;
        return static::where('user_id', \Auth::id())->first();
    }

    public function semuaPermohonan()
    {
        return $this->hasMany(Permohonan::class);
    }

    public function permohonanKonsepValidasi()
    {
        return $this->hasOne(Permohonan::class)->whereIn('status', [
            Permohonan::STATUS_KONSEP,
            Permohonan::STATUS_VALIDASI
        ]);
    }

    public function permohonanAktif()
    {
        return $this->hasOne(Permohonan::class)->whereIn('status', [
            Permohonan::STATUS_VERIFIKASI,
            Permohonan::STATUS_PROSES,
            Permohonan::STATUS_TELAAH,
            Permohonan::STATUS_PERBAIKI,
        ]);
    }

    public function getNamaAttribute()
    {
        return $this->user->name;
    }

    public function getEmailAttribute()
    {
        return $this->user->email;
    }

    public function getIdentitasLengkapAttribute(): bool
    {
        return $this->nohp && $this->alamat && $this->ktp;
    }

    public function ktp(): MorphOne
    {
        return $this->morphOne(File::class, 'model')->where(['key' => File::KEY_KTP]);
    }


}
