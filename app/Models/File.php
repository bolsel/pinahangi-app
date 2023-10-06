<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\MorphTo;
use Livewire\Features\SupportFileUploads\TemporaryUploadedFile;
use Storage;

class File extends Model
{
    use HasFactory;

    const KEY_KTP = 'ktp';
    const KEY_PERMOHONAN_JENIS_PEMOHON = 'permohonan_jenis_pemohon';
    const KEY_PERMOHONAN_DATA = 'permohonan_data';
    protected $fillable = ['path', 'name', 'user_id', 'key'];

    protected static function boot()
    {
        parent::boot();
        self::creating(function (File $model) {
            $model->user_id = auth()->id();
        });
        self::deleted(function (File $model) {
            $path = Storage::path($model->path);
            if (\File::exists($path)) {
                \File::delete($path);
            }
        });
    }

    public function model(): MorphTo
    {
        return $this->morphTo();
    }

    public function getUrlAttribute()
    {
        return Storage::url($this->path);
    }

    public function getPathSystemAttribute()
    {
        return Storage::path($this->path);
    }
}
