<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class VendaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        return [
            'livro_id'       => 'required|integer',
            'nu_quantidade'  => 'required|integer|min:1',
            'nu_cep'         => 'required|digits:8',
            'ds_complemento' => 'max:100',
            'ds_numero'      => 'string|max:10',
        ];
    }

    public function messages(): array
    {
        return [
            'livro_id.required'         => 'Livro não encontrado',

            'nu_quantidade.required'    => 'Quantidade é obrigatória',
            'nu_quantidade.min'         => 'Quantidade não suficiente para a venda do livro',

            'nu_cep.required'           => 'CEP é obrigatório.',
            'nu_cep.digits'             => 'O CEP deve conter exatamente 8 números.',

            'ds_complemento.max'        => 'Complemento inválido',
            'ds_numero.max'             => 'Complemento inválido',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
