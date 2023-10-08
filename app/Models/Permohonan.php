<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphMany;
use Illuminate\Database\Eloquent\Relations\MorphOne;

class Permohonan extends Model
{
    use HasFactory;

    const STATUS_KONSEP = 'konsep';
    const STATUS_VALIDASI = 'validasi';
    const STATUS_VERIFIKASI = 'verifikasi';
    const STATUS_VERIFIKASI_TOLAK = 'verifikasi_tolak';
    const STATUS_PROSES = 'proses';
    const STATUS_TELAAH = 'telaah';
    const STATUS_PERBAIKI = 'perbaiki'; // dikembalikan ke organisasi
    const STATUS_SELESAI = 'selesai';

    protected $table = 'permohonan';
    protected $fillable = [
        'nomor', 'pemohon_id', 'jenis_pemohon', 'status',
        'permohonan', 'data_pemohon', 'organisasi_id', 'data',
        'keterangan',
        'informasi',
    ];
    protected $casts = [
        'data' => 'json',
    ];

    public static function boot()
    {
        parent::boot();
        self::updating(function (Permohonan $p) {
            if ($p->status === Permohonan::STATUS_VERIFIKASI && !$p->nomor) {
                $date = date('ymd-His');
                $nomor = Permohonan::where('nomor', 'LIKE', $date . '%')->count();
                $nomor++;
                $p->nomor = $date . $nomor;
            }
            return true;
        });


    }

    public function pemohon()
    {
        return $this->belongsTo(Pemohon::class);
    }


    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }

    public function berkasJenis(): MorphOne
    {
        return $this->morphOne(File::class, 'model')->where(['key' => File::KEY_PERMOHONAN_JENIS_PEMOHON]);
    }

    public function log()
    {
        return $this->hasMany(PermohonanLog::class)->latest('waktu');
    }

    public function statusLog()
    {
        return $this->hasOne(PermohonanLog::class)->where('status', $this->status)->orderBy('waktu', 'desc');
    }

    public function dataFiles(): MorphMany
    {
        return $this->morphMany(File::class, 'model')->where(['key' => File::KEY_PERMOHONAN_DATA]);
    }

    public function getLastLogAttribute(): PermohonanLog|null
    {
        return $this->log()->orderBy('waktu', 'desc')->first();
    }

    public function getWaktuPermohonanAttribute()
    {
        return $this->log()
            ->where('status', self::STATUS_VALIDASI)->orderBy('waktu', 'desc')->first()?->waktu;
    }

    public function getWaktuVerifikasiAttribute()
    {
        return $this->log()
            ->where('status', self::STATUS_PROSES)->orderBy('waktu', 'desc')->first()?->waktu;
    }

    public function getWaktuProsesAttribute()
    {
        return $this->log()
            ->where('status', self::STATUS_TELAAH)->orderBy('waktu', 'desc')->first()?->waktu;
    }

    public function getJenisPemohonLabelAttribute()
    {
        return Pemohon::JENIS[$this->jenis_pemohon];
    }

    public static function countStatus($status)
    {
        return static::whereStatus($status)
            ->where(function ($q) {
                if (\Gate::check('roleIsOrganisasi')) {
                    $q->where('organisasi_id', auth()->user()->organisasi_id);
                }
            })
            ->count();
    }

    public static function countStatusProses()
    {
        return self::countStatus(self::STATUS_PROSES);
    }

    public static function countStatusVerifikasi()
    {
        return self::countStatus(self::STATUS_VERIFIKASI);
    }

    public static function countStatusVerifikasiTolak()
    {
        return self::countStatus(self::STATUS_VERIFIKASI_TOLAK);
    }

    public static function countStatusTelaah()
    {
        return self::countStatus(self::STATUS_TELAAH);
    }

    public static function countStatusPerbaiki()
    {

        return self::countStatus(self::STATUS_PERBAIKI);
    }

    public static function countStatusSelesai()
    {

        return self::countStatus(self::STATUS_SELESAI);
    }

    public function getIsPerbaikiAttribute()
    {
        return $this->status === self::STATUS_PERBAIKI;
    }

    public function getIsSelesaiAttribute()
    {
        return $this->status === self::STATUS_SELESAI;
    }

    public function kepuasan()
    {
        return $this->hasOne(PermohonanPuas::class);
    }

    public static function dataPemohonJenisConfig($key = null)
    {
        $config = [
            Pemohon::JENIS_BADAN_HUKUM => [
                'nama' => [
                    'label' => 'Nama Badan Hukum',
                    'required' => true,
                ],
                'alamat' => [
                    'label' => 'Alamat Badan Hukum',
                    'required' => true,
                    'textarea' => true
                ]
            ],
            Pemohon::JENIS_KELOMPOK => [
                'nama' => [
                    'label' => 'Nama Kelompok / Organisasi',
                    'required' => true,
                ],
                'alamat' => [
                    'label' => 'Alamat Kelompok / Organisasi',
                    'required' => true,
                    'textarea' => true
                ]
            ]
        ];
        if ($key) {
            return $config[$key] ?? [];
        }
        return $config;
    }
}
