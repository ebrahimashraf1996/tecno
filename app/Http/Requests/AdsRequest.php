<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdsRequest extends FormRequest
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
            'photo' => 'required_without:id|mimes:jpg,jpeg,png',
            'product_id' => 'required_if:type,1',
            'offer_id' => 'required_if:type,2',
        ];
    }

    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'max' => 'لقد تخطيت الحد الأقصي للكلمات والحروف والأرقام',
            'photo.required_without' => 'الصورة مطلوبة',
            'photo.mimes' => 'الأمتدادات المسموح بها jpg, jpeg, png',
            'product_id.required_if' => 'من فضلك اختر المنتج',
            'offer_id.required_if' => 'من فضلك اختر العرض',
        ];
    }
}
