<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'email',
        'username',
        'password',
        'verified',
        'verification_token',
        'email_verified_at',
        'forgot_password_token',
        'password_change_at',
        'role_id'
    ];

    // Implementasikan metode yang diperlukan oleh JWTSubject
    public function getJWTIdentifier()
    {
        return $this->getKey(); // Mengembalikan ID pengguna
    }

    public function getJWTCustomClaims()
    {
        return []; // Anda bisa menambahkan klaim kustom di sini jika diperlukan
    }
}
