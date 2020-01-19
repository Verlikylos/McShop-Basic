<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreSmsNumberRequest extends FormRequest
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
            'numberOperator' => [
                'required',
                Rule::in(array_keys(config('mcshop.sms_operators')))
            ],
            'numberNumber' => 'required|numeric|digits_between:3,10',
            'numberNetto' => 'required|numeric|min:1|max:100',
        ];
    }
}
