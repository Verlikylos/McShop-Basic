<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePaymentSettingsRequest extends FormRequest
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
            'paymentSmsOperator' => [
                'required',
                Rule::in(array_keys(config('mcshop.payment_providers.sms')))
            ],
            'paymentPscOperator' => [
                'required',
                Rule::in(array_keys(config('mcshop.payment_providers.psc')))
            ]
        ];
    }
}
