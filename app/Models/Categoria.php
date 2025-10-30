<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    const STATUS_ATIVO = 'ATIVO';
    const STATUS_INATIVO = 'INATIVO';


    protected $table = 'tb_categoria';

    protected $fillable = [
        'no_categoria',
        'in_ativo',
    ];
}
