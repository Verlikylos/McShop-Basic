<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateTemspeakWidgetSettingsRequest extends FormRequest
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
            'teamspeakAddress' => [
                'required',
                'ipv4'
            ],
            'teamspeakPort' => [
                'required',
                'numeric',
                'min:1024',
                'max:65535'
            ],
            'teamspeakDisplayAddress' => [
                'required',
                'regex:/^([a-zA-Z0-9][a-zA-Z0-9-]{1,61}\.)*[a-zA-Z0-9][a-zA-Z0-9-]{1,61}[a-zA-Z0-9]\.[a-zA-Z]{2,}$/'
            ],
            'teamspeakQueryPort' => [
                'required',
                'numeric',
                'min:1024',
                'max:65535'
            ],
            'teamspeakQueryUser' => [
                'required',
                'regex:/^[a-zA-Z0-9\_\.\ ]+$/',
                'min:3',
                'max:36'
            ],
            'teamspeakQueryPassword' => [
                'required',
                'alpha_num',
                'min:3',
                'max:36'
            ],
        ];
    }
}
