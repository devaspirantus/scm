<?php

namespace App\Http\Requests;

use Illuminate\Contracts\Validation\ValidationRule;
use Illuminate\Foundation\Http\FormRequest;
use Override;

class StudentRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required',
            'country_id' => 'required',
            'nationalID' => 'required',
            'phone' => 'required',
            'active' => 'required'
        ];
    }
    public function messages()
    {
        return [
            'name.required' =>'الاسم مطلوب',
            'country_id.required' => 'الدولة مطلوبة',
            'nationalID.required' => 'رقم الهوية مطلوب',
            'phone.required' => 'الهاتف مطلوب',
            'active.required' => 'التفعيل مطلوب',
        ];
    }
}
