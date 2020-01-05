<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'userName' => [
                'required',
                'alpha_dash',
                'min:4',
                'max:26',
                'unique:users,name'
            ],
            'permissionUsers' => 'filled',
            'permissionServers' => 'filled',
            'permissionServices' => 'filled',
            'permissionVouchers' => 'filled',
            'permissionPages' => 'filled',
            'permissionPurchases' => 'filled',
            'permissionLogs' => 'filled',
            'permissionSettings' => 'filled'
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
            'userName.required' => 'To pole nie może być puste!',
            'userName.alpha_dash' => 'Nazwa użytkownika może zawierać tylko znaki alfanumeryczne, myślniki i podkreślenia!',
            'userName.min' => 'Nazwa użytkownika jest zbyt krótka!',
            'userName.max' => 'Nazwa użytkownika jest zbyt długa!',
            'userName.unique' => 'Użytkownik o takiej nazwie już istenieje!'
        ];
    }
}
