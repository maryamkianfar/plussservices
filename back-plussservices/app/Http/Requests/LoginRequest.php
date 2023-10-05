<?php


namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rules\Password as PasswordRules;
class LoginRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array|string>
     */
    public function rules(): array
    {
        return [
            'email'=>['required','email','exists:users,email'],
            'password' => [
                        'required',
                        PasswordRules::min(8)->letters()->numbers(),
                        'string'
                    ]
        ];
    }
    public function messages(){
        return [
          'email.required' => 'El Email es obligatorio',
          'email.email' => 'El Email no es valido',
          'email.exists' => 'Esa cuenta no existe',
          'password' => 'El Password debe contener al menos 8 caracteres y un numero'
        ];
    }
}
