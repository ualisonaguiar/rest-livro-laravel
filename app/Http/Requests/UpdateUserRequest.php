<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
        $id = $this->route('id');

        return [
            'ds_nome'  => 'sometimes|string|max:150',
            'ds_email' => "sometimes|email|unique:tb_usuario,ds_email,{$id}|max:150",
            'ds_senha' => 'sometimes|string|min:6|max:60',
        ];
    }
}
