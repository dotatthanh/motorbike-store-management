<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class UpdateDiscountCodeRequest extends FormRequest
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
            'valid_from' => 'required|date',
            'valid_until' => 'required|date|after_or_equal:valid_from',
            'usage_limit' => 'nullable|numeric|min:1',
            'active' => 'nullable|numeric|in:0,1',
        ];
    }

    public function messages()
    {
        return [
            'valid_from.required' => 'Ngày bắt đầu hiệu lực là trường bắt buộc.',
            'valid_from.date' => 'Ngày bắt đầu hiệu lực không đúng định dạng ngày tháng năm.',
            'valid_until.required' => 'Ngày kết thúc hiệu lực là trường bắt buộc.',
            'valid_until.date' => 'Ngày kết thúc hiệu lực không đúng định dạng ngày tháng năm.',
            'valid_until.after_or_equal' => 'Ngày kết thúc hiệu lực phải là ngày sau hoặc bằng ngày bắt đầu hiệu lực.',
            'usage_limit.min' => 'Giới hạn số lần sử dụng phải lớn hơn hoặc bằng :min.',
            'usage_limit.numeric' => 'Giới hạn số lần sử dụng phải là kiểu số.',
            'active.required' => 'Trạng thái hoạt động là trường bắt buộc.',
            'active.numeric' => 'Trạng thái hoạt động phải là kiểu số.',
            'active.in' => 'Giá trị trạng thái hoạt động chưa đúng.',
        ];
    }
}
