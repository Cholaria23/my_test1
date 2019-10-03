<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateUserRequest extends FormRequest
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
            'translations_en_name' => 'required|string',
            'translations_ua_name' => 'required|string',
            'translations_ru_name' => 'required|string',
	    'translations_pt_name' => 'required|string',
	    'translations_es_name' => 'required|string',
        ];
    }
}
