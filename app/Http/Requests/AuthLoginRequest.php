<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AuthLoginRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
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
            'authUsername' => 'required|alpha_dash',
            'authPassword' => 'required|alpha_num',
            'authRemember' => 'nullable'
            ];
    }
    
    /**
     * Get the error messages for the defined validation rules.
     *
     * @return array
     */
    public function messages()
    {
        return [
            'authUsername.required' => 'To pole jest nie może być puste!',
            'authUsername.alpha_dash' => 'Login może zawierać tylko znaki alfanumeryczne, myślniki i podkreślenia!',
            'authPassword.required' => 'To pole jest nie może być puste!',
            'authPassword.alpha_num' => 'Hasło może zawierać tylko znaki alfanumeryczne!',
        ];
    }
}
