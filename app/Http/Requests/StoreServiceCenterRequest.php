<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreServiceCenterRequest extends FormRequest
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

            'translations_en_address' => 'required|string',
            'translations_ua_address' => 'required|string',
            'translations_ru_address' => 'required|string',
	    'translations_pt_address' => 'required|string',
	    'translations_es_address' => 'required|string',

            'translations_en_schedule' => 'required|string',
            'translations_ua_schedule' => 'required|string',
            'translations_ru_schedule' => 'required|string',
	    'translations_pt_schedule' => 'required|string',
	    'translations_es_schedule' => 'required|string',

            'translations_en_phones' => 'required|string',
            'translations_ua_phones' => 'required|string',
            'translations_ru_phones' => 'required|string',
	    'translations_pt_phones' => 'required|string',
	    'translations_es_phones' => 'required|string',

        ];
    }
}
