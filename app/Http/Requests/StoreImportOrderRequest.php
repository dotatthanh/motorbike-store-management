<?php

namespace App\Http\Requests;

use Illuminate\Foundation\Http\FormRequest;

class StoreImportOrderRequest extends FormRequest
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
            'supplier_id' => 'required|numeric|in:0,1',
            'import_orders' => 'required|array',
            'import_orders.*.product_id' => 'required',
            'import_orders.*.product_variant_id' => 'required',
            'import_orders.*.quantity' => 'required|numeric|min:1',
            'import_orders.*.price' => 'required|numeric|min:1',
        ];
    }

    public function messages()
    {
        return [
            'supplier_id.required' => 'Nhà cung cấp là trường bắt buộc.',
            'import_orders.required' => 'Chi tiết nhập hàng là trường bắt buộc.',
            'import_orders.array' => 'Chi tiết nhập hàng phải là mảng.',
            'import_orders.*.product_id.required' => 'Sản phẩm là trường bắt buộc.',
            'import_orders.*.product_variant_id.required' => 'Size và màu là trường bắt buộc.',
            'import_orders.*.quantity.required' => 'Số lượng là trường bắt buộc.',
            'import_orders.*.quantity.numeric' => 'Số lượng phải là kiểu số.',
            'import_orders.*.quantity.min' => 'Số lượng phải lớn hơn hoặc bằng :min.',
            'import_orders.*.price.required' => 'Giá nhập là trường bắt buộc.',
            'import_orders.*.price.numeric' => 'Giá nhập phải là kiểu số.',
            'import_orders.*.price.min' => 'Giá nhập phải lớn hơn hoặc bằng :min.',
        ];
    }
}
