<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class AdminAddRequest extends FormRequest
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
            'name' => ['required', 'string', 'max:255'],
            'email' => ['required', 'string', 'email', 'max:255', 'unique:admins,email'],
            'password' => ['required', 'string', 'min:5'],
        ];
    }
    public function messages()
    {
        return [
            'required' => 'هذا الحقل مطلوب',
            'string' => 'هذا الحقل يجب أن يكون أرقام وحروف',
            'max' => 'لقد تخطيت الحد الأقصي للحروف والأرقام ',
            'email.email' => 'البريد الألكتروني غير صحيح',
            'unique' => 'هذا البريد الإالكتروني مستخدم من قبل',
            'min' => 'حد أدني 5 حروف أو أرقام',
        ];
    }
}
