<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    const ROLE_SU = 'su';
    const ROLE_VERIFIKASI = 'verif';
    const ROLE_TELAAH = 'telaah';
    const ROLE_ORGANISASI = 'organisasi';
    const ROLE_USER = 'user';
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'organisasi_id'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public static function whereCanVerifikasi()
    {
        return static::whereIn('role', [self::ROLE_SU, self::ROLE_VERIFIKASI]);
    }

    public static function whereCanProses()
    {
        return static::whereIn('role', [self::ROLE_ORGANISASI]);
    }

    public static function whereCanTelaah()
    {
        return static::whereIn('role', [self::ROLE_SU, self::ROLE_TELAAH]);
    }

    public function pemohon()
    {
        return $this->hasOne(Pemohon::class);
    }

    public function organisasi()
    {
        return $this->belongsTo(Organisasi::class);
    }

    public function roleIsSuperuser(): bool
    {
        return $this->role === self::ROLE_SU;
    }

    public function roleIsVerifikasi(): bool
    {
        return $this->role === self::ROLE_SU;
    }

    public function roleIsUser(): bool
    {
        return $this->role === self::ROLE_USER;
    }

    public function roleIsTelaah(): bool
    {
        return $this->role === self::ROLE_TELAAH;
    }

    public function roleIsOrganisasi(): bool
    {
        return $this->role === self::ROLE_ORGANISASI;
    }


}
