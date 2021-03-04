<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateServiceRequest extends FormRequest
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
            'serviceName' => [
                'required',
                'regex:/^[a-zA-Z0-9\-\_\.\ ]+$/',
                'min:2',
                'max:36',
                Rule::unique('services', 'id')->ignore(request()->get('service'))
            ],
            'serviceServer' => [
                'required',
                'exists:servers,id'
            ],
            'serviceImage' => [
                Rule::dimensions()->minWidth(256)->minHeight(256)->ratio(1.0),
                'mimes:jpg,jpeg,png'
            ],
            'serviceDescription' => 'filled',
            'serviceCommands' => 'required|json|min:5',
            'serviceSmsNumber' => [
                'nullable',
                'exists:sms_numbers,id'
            ],
            'servicePscCost' => [
                'nullable',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'serviceTransferCost' => [
                'nullable',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
            'servicePaypalCost' => [
                'nullable',
                'regex:/^\d+(\.\d{1,2})?$/'
            ],
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
            'serviceCommands.min' => 'Usługa musi zawierać przynajmniej jedną komendę.'
        ];
    }
}
