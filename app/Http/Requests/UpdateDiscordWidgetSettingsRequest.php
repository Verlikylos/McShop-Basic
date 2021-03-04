<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class UpdateDiscordWidgetSettingsRequest extends FormRequest
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
            'discordServerId' => [
                'required',
                'digits:18',
            ],
            'discordHeight' => [
                'required',
                'numeric',
                'min:160',
                'max:500'
            ],
            'discordTheme' => [
                'required',
                Rule::in(['light', 'dark'])
            ]
        ];
    }
}
