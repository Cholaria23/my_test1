<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateArticleRequest extends FormRequest
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
            'slug' =>'required|string|unique:article_categories,slug,' . $this->id,
            'article_category_id' => 'nullable|exists:article_categories,id',

            'translations_en_title' => 'required|string',
            'translations_ua_title' => 'required|string',
            'translations_ru_title' => 'required|string',
	    'translations_pt_title' => 'required|string',
	    'translations_es_title' => 'required|string',

            'translations_en_content' => 'required|string',
            'translations_ua_content' => 'required|string',
            'translations_ru_content' => 'required|string',
	    'translations_pt_content' => 'required|string',
	    'translations_es_content' => 'required|string',
        ];
    }

}
