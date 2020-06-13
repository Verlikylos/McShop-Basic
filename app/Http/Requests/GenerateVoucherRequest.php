<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Str;
use Illuminate\Validation\Rule;

class GenerateVoucherRequest extends FormRequest
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
            'voucherService' => [
                'required',
                'numeric',
                'exists:services,id'
            ],
            'voucherUsagesAmount' => [
                'required',
                'numeric',
                'min:1',
                'max:100',
            ],
            'voucherCodePrefix' => [
                'nullable',
                'alpha_dash',
                'max:10'
            ],
            'voucherCodeLength' => [
                'required',
                'numeric',
                'min:6',
                'max:32',
            ],
            'voucherAmount' => [
                'required',
                'numeric',
                'min:1',
                'max:50'
            ],
        ];
    }
}
