<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StoreServerRequest extends FormRequest
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
            'serverName' => [
                'required',
                'regex:/^[a-zA-Z0-9\-\_\.\ ]+$/',
                'min:2',
                'max:36',
                'unique:servers,name'
            ],
            'serverImage' => [
                Rule::dimensions()->minWidth(256)->minHeight(256)->ratio(1.0),
                'mimes:jpg,jpeg,png'
            ],
            'serverDisplayAddress' => [
                'required',
                'regex:/^([a-zA-Z0-9][a-zA-Z0-9-]{1,61}\.)*[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/'
            ],
            'serverConnectionMethod' => [
                'required',
                Rule::in('api', 'rcon')
            ],
            'serverIpAddress' => [
                'nullable',
                Rule::requiredIf(request()->get('serverConnectionMethod') === 'rcon'),
                'ipv4'
            ],
            'serverPort' => [
                'nullable',
                Rule::requiredIf(request()->get('serverConnectionMethod') === 'rcon'),
                'numeric',
                'min:1024',
                'max:65535'
            ],
            'serverRconPort' => [
                'nullable',
                Rule::requiredIf(request()->get('serverConnectionMethod') === 'rcon'),
                'numeric',
                'min:1024',
                'max:65535'
            ],
            'serverRconPassword' => [
                'nullable',
                Rule::requiredIf(request()->get('serverConnectionMethod') === 'rcon'),
                'alpha_dash',
                'min:3',
                'max:16'
            ],
            'serverApiAddress' => [
                'nullable',
                Rule::requiredIf(request()->get('serverConnectionMethod') === 'api'),
                'url'
            ],
            'serverApiKey' => [
                'nullable',
                Rule::requiredIf(request()->get('serverConnectionMethod') === 'api'),
                'alpha_num',
                'max:128'
            ]
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
            'serverName.regex' => 'To pole może zawierać jedynie znaki alfanumeryczne, myślniki, podkreślenia, kropki oraz spacje.',
            'serverDisplayAddress.regex' => 'To pole musi zawierać poprawną domenę internetową.',
        ];
    }
}
