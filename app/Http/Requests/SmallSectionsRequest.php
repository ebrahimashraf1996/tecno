<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class SmallSectionsRequest extends FormRequest
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
            'small_p_ar' => 'required|max:150',
            'small_p_en' => 'required|max:200',
            'icon' => 'required',
            'large_section_id' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'large_section_id.required' => 'يرجي إضافة أقسام رئيسية أولا ثم إرفاق أقسام فرعية بها',
            'min' => 'لم تتخطي الحد الأدني للمحتوي',
            'max' => 'لقد تخطيت الحد الأقصي للكلمات والحروف والأرقام',
        ];
    }
}
