<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateSchoolRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        if (auth()->check() && auth()->user()->isAdmin()) {
            return true;
        }

        return false;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [
            'translations_en_title' => 'required|string',
            'translations_ua_title' => 'required|string',
            'translations_ru_title' => 'required|string',
	    'translations_pt_title' => 'required|string',
	    'translations_es_title' => 'required|string',

            'translations_en_country' => 'required|string',
            'translations_ua_country' => 'required|string',
            'translations_ru_country' => 'required|string',
	    'translations_pt_country' => 'required|string',
	    'translations_es_country' => 'required|string',

            'translations_en_city' => 'required|string',
            'translations_ua_city' => 'required|string',
            'translations_ru_city' => 'required|string',
	    'translations_pt_city' => 'required|string',
	    'translations_es_city' => 'required|string',
        ];
    }
}
