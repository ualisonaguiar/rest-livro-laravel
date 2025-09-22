<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class User extends Model
{
    use HasFactory;

    protected $table = 'tb_usuario';

    protected $fillable = [
        'ds_nome',
        'ds_email',
        'ds_senha',
    ];

    protected $hidden = ['ds_senha'];

    public function setDsSenhaAttribute(String $value): void {
        $this->attributes['ds_senha'] = Hash::make($value);
    }
}
