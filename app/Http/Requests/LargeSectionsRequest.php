<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class LargeSectionsRequest extends FormRequest
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
            'title_ar' => 'required|max:25',
            'title_en' => 'required|max:25',
            'large_p_ar' => 'max:5000',
            'large_p_en' => 'max:5000',
            'photo' => 'required_if:large_p_ar,|required_if:large_p_en,|mimes:jpg,jpeg,png',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'photo.required_if' => 'الصورة مطلوبة في حالة عدم وجود محتوي لكلا من اللغتين',
            'photo.mimes' => 'الأمتدادات المسموح بها jpg, jpeg, png',
            'min' => 'لم تتخطي الحد الأدني للمحتوي',
            'max' => 'لقد تخطيت الحد الأقصي للكلمات والحروف والأرقام',
        ];
    }
}
