<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\Validator;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Http\Exceptions\HttpResponseException;

class PessoaRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    protected function failedValidation(Validator $validator)
    {
        throw new HttpResponseException(response()->json([
            'status'=>false,
            'errors'=>$validator->errors()
        ], 422));
    }

    public function rules(): array
    {
        $pessoaId = $this->route('pessoa') ? $this->route('pessoa')->id : null;

        return [
            'nome' => 'required',
            'email' => 'required|email|unique:pessoas,email' . ($pessoaId ? ",$pessoaId" : ''),
            'telefone' => 'required|min:11',
        ];
    }

    public function messages(): array
    {
        return [
            'name.required' => 'Campo nome é obrigatório!',
            'email.required' => 'Campo email é obrigatório!',
            'email.email' => 'Necessário enviar email válido!',
            'email.unique' => 'O email já está cadastrado!',
            'telefone.required' => 'Campo telefone é obrigatório!',
            'telefone.min' => 'Senha com no mínimo :min caracteres!',
        ];
    }
}
