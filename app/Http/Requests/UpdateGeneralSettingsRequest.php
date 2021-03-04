<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateGeneralSettingsRequest extends FormRequest
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
            'settingPageTitle' => [
                'required',
                'regex:/^[a-zA-Z0-9\-\_\.\ ]+$/',
                'min:2',
            ],
            'settingPageDescription' => 'required',
            'settingPageTags' => 'required',
            'settingFavicon' => 'required|url',
            'settingPageLogo' => 'required',
            'settingPageBackground' => 'required'
        ];
    }
}
