<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PessoaRequest extends FormRequest
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
            'nome'  => 'required',
            'idade' => 'required|integer'
        ];
    }

    public function messages() {
        return [
            'nome.required'     => 'O campo "Nome" é de preenchimento obrigatório.',
            'idade.required'    => 'O campo "Idade" é de preenchimento obrigatório.',
            'idade.integer'     => 'O campo "Idade" deve ser numérico.'
        ];
    }
}
