<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Organisasi extends Model
{
    use HasFactory;

    protected $table = 'organisasi';
    protected $fillable = [
        'nama', 'alamat', 'nohp'
    ];

    public function users()
    {
        return $this->hasMany(User::class);
    }

    public static function selectOptionValues(): array
    {
        return static::orderBy('nama')->get()?->mapWithKeys(function ($m) {
            return [$m->id => $m->nama];
        })->toArray() ?? [];
    }
}
