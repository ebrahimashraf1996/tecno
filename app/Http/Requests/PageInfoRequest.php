<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PageInfoRequest extends FormRequest
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
            'title_ar' => 'required',
            'title_en' => 'required',
            'logo' => 'required_without:id|mimes:jpg,jpeg,png'
        ];
    }

    public function messages()
    {
        return [
            'title_ar.required' => 'اسم الموقع مطلوب',
            'title_en.required' => 'اسم الموقع مطلوب',
            'logo.required_without:id' => 'لوجو الموقع مطلوب',
            'logo.mimes' => 'الأمتدادات المسموح بها jpg, jpeg, png',
        ];
    }
}
