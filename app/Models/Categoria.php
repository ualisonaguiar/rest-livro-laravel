<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Categoria extends Model
{
    const STATUS_ATIVO = 'Ativo';
    const STATUS_INATIVO = 'Inativo';


    protected $table = 'tb_categoria';

    protected $fillable = [
        'no_categoria',
        'in_ativo',
    ];
}
