<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class FooterContactsRequest extends FormRequest
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
            'span_ar' => 'required|max:80',
            'span_en' => 'required|max:80',
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
