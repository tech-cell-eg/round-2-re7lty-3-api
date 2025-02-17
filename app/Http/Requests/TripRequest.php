<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class TripRequest extends FormRequest
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
    public function rules(): array {
        return [
            'location' => 'required|string|max:255',
            'price' => 'required|numeric|min:0',
            'duration_days' => 'required|integer|min:1',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ];
    }
    public function messages() {
        return [
            'location.required' => 'المكان مطلوب.',
            'location.string' => 'المكان يجب أن يكون نصًا.',
            'location.max' => 'المكان لا يمكن أن يتجاوز 255 حرفًا.',
            'price.required' => 'السعر مطلوب.',
            'price.numeric' => 'السعر يجب أن يكون رقمًا.',
            'price.min' => 'السعر يجب أن يكون غير سالب.',
            'duration_days.required' => 'عدد الأيام مطلوب.',
            'duration_days.integer' => 'عدد الأيام يجب أن يكون عددًا صحيحًا.',
            'duration_days.min' => 'عدد الأيام يجب أن يكون على الأقل 1 يوم.',
            'image.image' => 'يجب أن يكون الملف صورة.',
            'image.mimes' => 'الصورة يجب أن تكون بصيغة: jpeg, png, jpg, gif.',
            'image.max' => 'حجم الصورة يجب ألا يتجاوز 2 ميجابايت.',
        ];
    }
}
