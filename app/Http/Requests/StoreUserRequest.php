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
}
