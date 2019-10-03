<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreFaqRequest extends FormRequest
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
            'translations_en_question' => 'required|string',
            'translations_ua_question' => 'required|string',
            'translations_ru_question' => 'required|string',
	    'translations_pt_question' => 'required|string',
	    'translations_es_question' => 'required|string',
 

            'translations_en_answer' => 'required|string',
            'translations_ua_answer' => 'required|string',
            'translations_ru_answer' => 'required|string',
	    'translations_pt_answer' => 'required|string',
	    'translations_es_answer' => 'required|string',
        ];
    }
}
