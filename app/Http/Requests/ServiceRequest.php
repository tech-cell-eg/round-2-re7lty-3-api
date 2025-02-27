<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ServiceRequest extends FormRequest
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
     * @return array<string, \Illuminate\Contracts\Validation\ValidationRule|array<mixed>|string>
     */
    public function rules(): array
    {
        return [
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:4096',
        ];
    }

    public function messages() {
        return [
            'name.required' => 'اسم الخدمة مطلوب.',
            'name.string' => 'اسم الخدمة يجب أن يكون نصًا.',
            'name.max' => 'اسم الخدمة لا يمكن أن يتجاوز 255 حرفًا.',
            'description.required' => 'الوصف مطلوب.',
            'description.string' => 'الوصف يجب أن يكون نصًا.',
            'image.image' => 'يجب أن يكون الملف صورة.',
            'image.mimes' => 'الصورة يجب أن تكون بصيغة: jpeg, png, jpg, gif.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ];
    }
}
