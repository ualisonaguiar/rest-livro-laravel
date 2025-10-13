<?php

namespace App\Services;

use App\Events\CompraRealizadaEvent;
use App\Models\VendaEntrega;
use Illuminate\Support\Facades\DB;

class VendaEntregaService implements VendaEntregaInterface
{
    public function __construct(private CepService $cepService) {}

    public function salvar(array $data): VendaEntrega
    {
        return DB::transaction(function () use ($data) {
            $dadosCep = $this->cepService->buscarCep($data['nu_cep']);

            $dataVendaEntrega = [
                'venda_id' => $data['venda_id'],
                'nu_cep' => $data['nu_cep'],
                'ds_logradouro' => $dadosCep['logradouro'],
                'ds_complemento' => $data['ds_complemento'],
                'ds_bairro' => $dadosCep['bairro'],
                'nu_ibge' => $dadosCep['ibge'],
                'ds_municipio' => $dadosCep['localidade'],
                'ds_estado' => $dadosCep['uf'],
                'ds_numero' => $data['ds_numero'],
            ];

            $vendaEntrega = VendaEntrega::updateOrCreate(
                ['venda_id' => $data['venda_id']],
                $dataVendaEntrega
            );

            //evento responsável por enviar e-mail ao usuario
            event(new CompraRealizadaEvent($vendaEntrega));

            //emitir a nota fiscal
            //ProcessaEnviaNotaFiscalJob::dispatch($vendaEntrega);

            return $vendaEntrega;
        });
    }
}
