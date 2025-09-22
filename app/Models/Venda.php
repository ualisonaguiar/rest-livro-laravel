<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'tb_venda';

    protected $fillable = [
        'livro_id',
        'nu_preco',
        'nu_quantidade',
    ];
}
