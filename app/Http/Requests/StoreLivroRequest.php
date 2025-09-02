<?php

namespace App\Http\Requests;

use Carbon\Carbon;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class StoreLivroRequest extends FormRequest
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
            'no_nome'       => 'required|string|max:100',
            'no_autor'      => 'required|string|max:150',
            'nu_quantidade' => 'required|integer|min:0',
            'nu_preco'      => 'required|numeric|min:0',
            'dt_lancamento' => 'required|date|before_or_equal:today',
        ];
    }

    public function messages(): array
    {
        return [
            'no_nome.required'       => 'O nome do livro é obrigatório.',
            'no_nome.string'         => 'O nome do livro deve ser um texto.',
            'no_nome.max'            => 'O nome do livro não pode ter mais de 100 caracteres.',

            'no_autor.required'      => 'O autor é obrigatório.',
            'no_autor.string'        => 'O autor deve ser um texto.',
            'no_autor.max'           => 'O autor não pode ter mais de 150 caracteres.',

            'nu_quantidade.required' => 'A quantidade é obrigatória.',
            'nu_quantidade.integer'  => 'A quantidade deve ser um número inteiro.',
            'nu_quantidade.min'      => 'A quantidade não pode ser inferior a 0.',

            'nu_preco.required'      => 'O preço é obrigatório.',
            'nu_preco.numeric'       => 'O preço deve ser um número.',
            'nu_preco.min'           => 'O preço não pode ser negativo.',

            'dt_lancamento.required' => 'A data de lançamento é obrigatória.',
            'dt_lancamento.date'     => 'A data de lançamento deve ser uma data válida.',
            'dt_lancamento.before_or_equal' => 'A data de lançamento não pode ser superior à atual.',
        ];
    }

    protected function failedValidation(Validator $validator):void
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }

    protected function withValidator(Validator $validator): void
    {
        $validator->after(function ($validator) {
            $this->withValidatorDtLancamento($validator);
            $this->withValidatorNuQuantidade($validator);
        });
    }

    protected function withValidatorDtLancamento(Validator $validator): void {
        $dtLancamento = Carbon::createFromFormat('Y-m-d', $this->dt_lancamento);
        if ($dtLancamento->gt(Carbon::now())) {
            $validator->errors()->add('dt_lancamento', 'A data de lançamento não pode ser superior.');
        }
    }

    protected function withValidatorNuQuantidade(Validator $validator): void {
        if ($this->nu_quantidade < 0) {
            $validator->errors()->add('nu_quantidade', 'A quantidade não poder ser inferior a 0.');
        }
    }
}
