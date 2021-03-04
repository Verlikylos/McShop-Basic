<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdatePageRequest extends FormRequest
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
            'pageName' => [
                'required',
                'regex:/^[a-zA-Z0-9\-\_\.\ ]+$/',
                'min:2',
                'max:36',
                Rule::unique('pages', 'name')->ignore(request()->get('page'))
            ],
            'pageIcon' => [
                'nullable',
                'regex:/^((fas)|(far)|(fal)|(fab)){1}\ (fa-){1}[a-zA-Z\-]{1,64}$/'
            ],
            'pageType' => [
                'required',
                Rule::in(['PAGE', 'LINK'])
            ],
            'pageContent' => [
                'nullable',
                'required_if:pageType,PAGE'
            ],
            'pageLink' => [
                'nullable',
                'url',
                'required_if:pageType,LINK'
            ]
        ];
    }
}
