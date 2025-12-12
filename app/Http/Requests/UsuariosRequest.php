<?php

namespace App\Http\Requests;

use App\Actions\Fortify\PasswordValidationRules;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\Validator;

class UsuariosRequest extends FormRequest
{
    use PasswordValidationRules;
    /**
     * Verifica se o usuario esta autorizado para fazer essa requesição.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'username' => 'required|string|unique:users',
            'roles' => 'required',
            'password'=> $this->passwordRules(),
        ];
    }
}
