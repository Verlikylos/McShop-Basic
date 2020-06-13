<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateVoucherSettingsRequest extends FormRequest
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
            'voucherDefaultPrefix' => [
                'nullable',
                'alpha_dash',
                'max:10'
            ],
            'voucherDefaultCodeLength' => [
                'required',
                'numeric',
                'min:6',
                'max:32',
            ]
        ];
    }
}
