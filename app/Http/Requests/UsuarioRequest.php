<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class UsuarioRequest extends FormRequest
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
            'ds_nome'     => 'required|string|max:150',
            'ds_email' => 'required|string|email|max:150|unique:tb_usuario,ds_email',
        ];
    }

    public function messages(): array
    {
        return [
            'ds_nome.required'      => 'A senha é obrigatório.',
            'ds_nome.string'        => 'A senha deve ser um texto.',
            'ds_nome.max'           => 'A senha não pode ter mais de 60 caracteres.',

            'ds_email.required'       => 'E-mail é obrigatório.',
            'ds_email.string'         => 'E-mail deve ser um texto.',
            'ds_email.max'            => 'O e-mail não pode ter mais de 60 caracteres.',
            'ds_email.email'          => 'O e-mail inválido.',
            'ds_email.unique'         => 'Este e-mail já está sendo utilizado.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
