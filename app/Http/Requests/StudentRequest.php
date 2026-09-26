<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Validation\Rule;

class StudentRequest extends FormRequest
{
    public function authorize(): bool
    {
        return true;
    }

    public function rules(): array
    {
        // ✅ نحدد إذا كنا في وضع "الإضافة" أو "التحديث"
        $isUpdate = $this->route('student') !== null || $this->route('id') !== null;

        $rules = [
            'name'       => 'required|string|max:255',
            'country_id' => 'required|exists:countries,id',
            'phone'      => 'required|string|max:20',
            'address'    => 'nullable|string|max:500',
            'notes'      => 'nullable|string',
            'photo'      => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
            'active'     => 'required|in:0,1',
        ];

        // ✅ قواعد الـ nationalID حسب السياق
        if ($isUpdate) {
            // عند التحديث: لا نتحقق من التكرار لأنه لا يتغير
            $rules['nationalID'] = ['required', 'string'];
        } else {
            // عند الإضافة: نتحقق من التكرار
            $rules['nationalID'] = [
                'required',
                'string',
                Rule::unique('students', 'nationalID'),
            ];
        }

        return $rules;
    }

    public function messages(): array
    {
        return [
            'name.required'       => 'اسم الطالب مطلوب.',
            'country_id.required' => 'يرجى اختيار الدولة.',
            'country_id.exists'   => 'الدولة المختارة غير صالحة.',
            'nationalID.required' => 'رقم الهوية مطلوب.',
            'nationalID.unique'   => 'رقم الهوية هذا مسجل مسبقاً لطالب آخر.',
            'phone.required'      => 'رقم الهاتف مطلوب.',
            'photo.image'         => 'الملف المرفق يجب أن يكون صورة.',
            'photo.max'           => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
            'active.required'     => 'حالة التفعيل مطلوبة.',
        ];
    }
}