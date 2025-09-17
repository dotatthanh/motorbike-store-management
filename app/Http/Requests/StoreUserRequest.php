<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreUserRequest extends FormRequest
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
            'name' => 'required|max:255',
            'email' => 'required|string|email|unique:users|max:255',
            'gender' => 'required',
            'birthday' => 'required|date',
            'phone_number' => 'required|size:10',
            'address' => 'required|max:255',
            'avatar' => 'required|image',
            'roles' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'name.required' => 'Họ và tên là trường bắt buộc.',
            'name.max' => 'Họ và tên không được dài quá :max ký tự.',
            'gender.required' => 'Giới tính là trường bắt buộc.',
            'birthday.required' => 'Ngày sinh là trường bắt buộc.',
            'birthday.date' => 'Ngày sinh không đúng định dạng.',
            'phone_number.required' => 'Số điện thoại là trường bắt buộc.',
            'phone_number.size' => 'Số điện thoại phải là :size số.',
            'address.required' => 'Địa chỉ là trường bắt buộc.',
            'address.max' => 'Địa chỉ không được dài quá :max ký tự.',
            'email.required' => 'Email là trường bắt buộc.',
            'email.email' => 'Email chưa đúng định dạng.',
            'email.unique' => 'Email đã tồn tại.',
            'email.string' => 'Email phải là một chuỗi.',
            'email.max' => 'Email không được dài quá :max ký tự.',
            'avatar.required' => 'Ảnh đại diện là trường bắt buộc!',
            'avatar.image' => 'Ảnh đại diện phải là tệp tin dạng ảnh!',
            'roles.required' => 'Vai trò là trường bắt buộc.',
        ];
    }
}
