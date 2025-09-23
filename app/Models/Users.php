<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use PHPOpenSourceSaver\JWTAuth\Contracts\JWTSubject;

class Users extends Authenticatable implements JWTSubject
{
    use HasFactory, Notifiable;

    protected $table = 'tb_usuario';

    protected $fillable = [
        'ds_nome',
        'ds_email',
        'ds_senha',
    ];

    protected $hidden = [
        'ds_senha',
        'remember_token'
    ];

    public function setDsSenhaAttribute(String $value): void
    {
        $this->attributes['ds_senha'] = sha1($value);
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }


    public function getJWTCustomClaims()
    {
        return [];
    }

    public function getAuthIdentifierName()
    {
        return 'ds_email';
    }

    public function getAuthPassword()
    {
        return $this->ds_senha;
    }
}
