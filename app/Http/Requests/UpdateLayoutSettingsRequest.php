<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateLayoutSettingsRequest extends FormRequest
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
        $themes = [];
        
        foreach (config('mcshop.themes') as $theme) {
            $themes[] = strtolower(str_replace([' ', '.io'], ['-', ''], $theme));
        }
        
        return [
            'layoutTheme' => [
                'required',
                Rule::in($themes)
            ]
        ];
    }
}
