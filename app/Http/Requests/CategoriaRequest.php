<?php

namespace App\Http\Requests;

use App\Models\Categoria;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;
use Illuminate\Validation\Rule;

class CategoriaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'no_categoria' => [
                'required',
                'string',
                'min:5',
                'max:100',
                Rule::unique('tb_categoria', 'no_categoria'),
            ],
            'in_ativo' => [
                'required',
                Rule::in([Categoria::STATUS_ATIVO, Categoria::STATUS_INATIVO])
            ],
        ];
    }

    public function messages(): array
    {
        return [
            'no_categoria.required' => 'O nome da categoria é obrigatório.',
            'no_categoria.string'   => 'O nome da categoria deve ser um texto.',
            'no_categoria.min'      => 'O nome da categoria deve ter no mínimo 5 caracteres.',
            'no_categoria.max'      => 'O nome da categoria deve ter no máximo 100 caracteres.',
            'no_categoria.unique'   => 'O nome da categoria já existe.',

            'in_ativo.required'     => 'A situação é obrigatória.',
            'in_ativo.in'           => 'A situação deve ser "Ativo" ou "Inativo".',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
