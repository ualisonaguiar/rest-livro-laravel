<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

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
            'no_nome'  => 'required|string|max:100',
            'no_autor'  => 'required|string|max:150',
            'nu_quantidade' => 'required',
            'nu_preco' => 'required',
            'dt_lancamento' => 'required',
        ];
    }
}
