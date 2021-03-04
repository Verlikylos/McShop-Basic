<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateMicroSmsPaymentSettingsRequest extends FormRequest
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
            'microsmsUserId' => [
                'required',
                'regex:/^[0-9]{1,10}$/'
            ],
            'microsmsSmsChannel' => [
                'required',
                'regex:/^([A-Z0-9\_\-])+\.([A-Z0-9\_\-])+$/'
            ],
            'microsmsSmsChannelId' => [
                'required',
                'regex:/^[0-9]{1,10}$/'
            ]
        ];
    }
}
