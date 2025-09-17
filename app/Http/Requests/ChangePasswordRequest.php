<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class ChangePasswordRequest extends FormRequest
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
            'password' => 'required|string|min:8',
            'password_confirmation' => 'required|string|min:8|same:password',
        ];
    }

    public function messages()
    {
        return [
            'password_confirmation.required' => 'Xác nhận mật khẩu là trường bắt buộc.',
            'password_confirmation.same' => 'Xác nhận mật khẩu không trùng với mật khẩu mới.',
            'password_confirmation.string' => 'Xác nhận mật khẩu không được chứa các ký tự đặc biệt.',
            'password.required' => 'Mật khẩu mới là trường bắt buộc.',
            'password.string' => 'Mật khẩu mới không được chứa các ký tự đặc biệt.',
            'password.min' => 'Mật khẩu mới phải ít nhất 8 ký tự.',
            'password_confirmation.min' => 'Xác nhận mật khẩu phải ít nhất 8 ký tự.',
        ];
    }
}
