<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreSupplierRequest extends FormRequest
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
            'address' => 'required|max:255',
            'phone_number' => 'required|size:10',
            'email' => 'required|string|email|unique:suppliers|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Tên nhà cung cấp không được chứa các ký tự đặc biệt.',
            'name.max' => 'Tên nhà cung cấp không được phép quá 255 ký tự.',
            'name.required' => 'Tên nhà cung cấp là trường bắt buộc.',
            'phone_number.required' => 'Số điện thoại là trường bắt buộc.',
            'phone_number.size' => 'Số điện thoại phải là :size số.',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
            'address.max' => 'Địa chỉ không được dài quá :max ký tự.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email chưa đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.string' => 'Email phải là một chuỗi.',
            'email.max' => 'Email không được dài quá :max ký tự.',
        ];
    }
}
