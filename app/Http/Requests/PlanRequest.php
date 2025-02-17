<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class PlanRequest extends FormRequest
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
            'price' => 'required|numeric|min:0',
            'plan_type' => 'required|in:economic,family,business',
            'target_type' => 'required|in:individual,group',
            'description' => 'required|string|max:500',
            'options' => 'nullable|array',
        ];
    }
    public function messages()
    {
        return [
            'price.required' => 'السعر مطلوب.',
            'price.numeric' => 'السعر يجب أن يكون رقمًا.',
            'price.min' => 'السعر يجب أن يكون غير سالب.',
            'plan_type.required' => 'نوع الخطة مطلوب.',
            'plan_type.in' => 'نوع الخطة غير صالح.',
            'target_type.required' => 'نوع المستفيد مطلوب.',
            'target_type.in' => 'نوع المستفيد غير صالح.',
            'description.required' => 'الوصف مطلوب.',
            'description.string' => 'الوصف يجب أن يكون نصًا.',
            'description.max' => 'الوصف لا يمكن أن يتجاوز 500 حرف.',
            'options.array' => 'الخيارات يجب أن تكون مصفوفة.',
        ];
    }
}
