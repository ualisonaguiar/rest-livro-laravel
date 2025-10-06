<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VendaEntrega extends Model
{
    use HasFactory;

    protected $table = 'tb_venda_entrega';

    protected $fillable = [
        'venda_id',
        'nu_cep',
        'ds_logradouro',
        'ds_complemento',
        'ds_bairro',
        'nu_ibge',
        'ds_municipio',
        'ds_estado',
        'ds_numero',
    ];

    public function vendaEntrega()
    {
        return $this->belongsTo(Venda::class, 'venda_id');
    }

    public static function findByVendaId(int $vendaId): ?self
    {
        return self::where('venda_id', $vendaId)->first();
    }
}
