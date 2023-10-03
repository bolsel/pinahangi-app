<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

class PermohonanLog extends Model
{
    protected $table = 'permohonan_log';
    public $timestamps = false;

    protected $fillable = [
        'permohonan_id', 'status', 'keterangan', 'user_id', 'waktu'
    ];
    protected $casts = [
        'waktu' => 'datetime'
    ];

    protected static function boot()
    {
        parent::boot();
        self::creating(function (PermohonanLog $model) {
            if (!$model->user_id) {
                $model->user_id = \Auth::id();
            }
            if (!$model->waktu) {
                $model->waktu = Carbon::now();
            }
            return true;
        });
//        self::created(function (PermohonanLog $model) {
//            Permohonan::find($model->permohonan_id)->update(['status' => $model->status]);
//            if (!app()->environment('local')) {
//                if ($model->status !== Permohonan::STATUS_KONSEP) {
//                    PermohonanLogMailJob::dispatch($model);
//                }
//            }
//        });
    }

    public function permohonan()
    {
        return $this->belongsTo(Permohonan::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
