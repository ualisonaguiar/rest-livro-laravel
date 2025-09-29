<?php

namespace App\Models;

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Users extends Authenticatable implements JWTSubject
{
    use Notifiable;

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
        return 'id';
    }

    public function getAuthPassword()
    {
        return $this->ds_senha;
    }

    protected function casts(): array
    {
        return [
            'ds_senha' => 'hashed',
        ];
    }
}
