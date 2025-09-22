<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Livro;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'tb_venda';

    protected $fillable = [
        'nu_cpf',
        'livro_id',
        'nu_preco',
        'nu_quantidade',
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_id');
    }
}
