<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Livro extends Model
{
    use HasFactory;

    protected $table = 'tb_livro';

    protected $fillable = [
        'no_nome',
        'no_autor',
        'nu_quantidade',
        'nu_preco',
        'dt_lancamento'
    ];
}
