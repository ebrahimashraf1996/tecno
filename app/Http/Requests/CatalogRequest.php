<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class CatalogRequest extends FormRequest
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
            'title_ar' => 'required|max:500',
            'title_en' => 'required|max:500',
            'content_ar' => 'required|max:2000',
            'content_en' => 'required|max:2000',
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'pdf' => 'required_without:id|mimes:pdf',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'max' => 'لقد تخطيت الحد الأقصي للكلمات والحروف والأرقام',
            'photo.required_without' => 'الصورة مطلوبة',
            'photo.mimes' => 'الأمتدادات المسموح بها jpg, jpeg, png',
            'pdf.required_without' => 'الصورة مطلوبة',
            'pdf.mimes' => 'الأمتدادات المسموح بها PDF',
        ];
    }
}
