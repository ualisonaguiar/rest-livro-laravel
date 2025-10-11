<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Livro;
use App\Models\VendaEntrega;

class Venda extends Model
{
    use HasFactory;

    protected $table = 'tb_venda';

    protected $fillable = [
        'usuario_id',
        'livro_id',
        'nu_preco',
        'nu_quantidade',
    ];

    public function livro()
    {
        return $this->belongsTo(Livro::class, 'livro_id');
    }

    public function livroEntrega()
    {
        return $this->hasOne(VendaEntrega::class, 'venda_id');
    }

    public function usuario()
    {
        return $this->belongsTo(Users::class, 'usuario_id');
    }
}
