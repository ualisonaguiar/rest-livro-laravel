<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Contracts\Validation\Validator;
use Illuminate\Http\Exceptions\HttpResponseException;

class AuthLoginRequest extends FormRequest
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
            'email'       => 'required|string|max:150',
            'password'    => 'required|string|max:60',
        ];
    }

    public function messages(): array
    {
        return [
            'email.required'       => 'E-mail é obrigatório.',
            'email.string'         => 'E-mail deve ser um texto.',
            'email.max'            => 'O e-mail não pode ter mais de 60 caracteres.',
            'email.email'          => 'O e-mail inválido.',

            'password.required'      => 'A senha é obrigatório.',
            'password.string'        => 'A senha deve ser um texto.',
            'password.max'           => 'A senha não pode ter mais de 60 caracteres.',
        ];
    }

    protected function failedValidation(Validator $validator): void
    {
        throw new HttpResponseException(response()->json($validator->errors(), 422));
    }
}
