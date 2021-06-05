<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FooterParagraphRequest extends FormRequest
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
            'title_ar' => 'required|max:50',
            'title_en' => 'required|max:50',
            'content_ar' => 'required|max:500',
            'content_en' => 'required|max:500',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'max' => 'لقد تخطيت الحد الأقصي للكلمات والحروف والأرقام',
        ];
    }
}
