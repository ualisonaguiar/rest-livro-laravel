<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'ds_nome'  => 'required|string|max:150',
            'ds_email' => 'required|email|unique:tb_usuario,ds_email|max:150',
            'ds_senha' => 'required|string|min:6|max:60',
        ];
    }
}
