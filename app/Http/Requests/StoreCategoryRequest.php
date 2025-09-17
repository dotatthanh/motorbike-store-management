<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreCategoryRequest extends FormRequest
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
            'is_show' => 'required|in:0,1',
            'sort' => 'nullable|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Tên danh mục không được chứa các ký tự đặc biệt.',
            'name.max' => 'Tên danh mục không được phép quá 255 ký tự.',
            'name.required' => 'Tên danh mục là trường bắt buộc.',
            'is_show.required' => 'Hiển thị là trường bắt buộc.',
            'is_show.in' => 'Giá trị hiển thị chưa đúng.',
            'sort.required' => 'Sắp xếp là trường bắt buộc.',
            'sort.min' => 'Sắp xếp phải lớn hơn hoặc bằng :min.',
            'sort.numeric' => 'Sắp xếp phải là kiểu số.',
        ];
    }
}
