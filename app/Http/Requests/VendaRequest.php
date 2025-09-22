<?php

namespace App\Http\Requests;

use Carbon\Carbon;
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
            'nu_cpf'        => 'required|string|min:11|max:11',
            'livro_id'      => 'required|integer',
            'nu_quantidade' => 'required|integer|min:1',
        ];
    }

    public function messages(): array
    {
        return [
            'nu_cpf.required'           => 'CPF é obrigatório.',
            'nu_cpf.min'                => 'CPF inválido',
            'nu_cpf.max'                => 'CPF inválido',

            'livro_id.required'         => 'Livro não encontrado',

            'nu_quantidade.required'    => 'Quantidade é obrigatória',
            'nu_quantidade.min'         => 'Quantidade não suficiente para a venda do livro',
        ];
    }

    protected function failedValidation(Validator $validator):void
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }    
}