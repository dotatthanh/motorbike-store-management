<?php

namespace App\Http\Requests;

use App\Rules\Color;
use Illuminate\Foundation\Http\FormRequest;

class UpdateProductRequest extends FormRequest
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
            'file_path' => 'nullable|image',
            'price' => 'required|min:1|numeric',
            'sale' => 'nullable|between:1,100|numeric',
            'categories' => 'required',
            'supplier_id' => 'required',
            'product_images' => 'required',
            'description' => 'nullable',
            'variants' => 'required|array',
            'variants.*.size' => 'required',
            'variants.*.color_code' => ['required', new Color],
            'variants.*.color_name' => 'required|string|max:255',
        ];
    }

    public function messages()
    {
        return [
            'name.string' => 'Tên sản phẩm không được chứa các ký tự đặc biệt.',
            'name.max' => 'Tên sản phẩm không được phép quá 255 ký tự.',
            'name.required' => 'Tên sản phẩm là trường bắt buộc.',
            'file_path.image' => 'Ảnh sản phẩm phải là tệp tin dạng ảnh.',
            'price.required' => 'Giá bán là trường bắt buộc.',
            'price.min' => 'Giá bán phải lớn hơn hoặc bằng :min.',
            'price.numeric' => 'Giá bán phải là kiểu số.',
            'sale.numeric' => 'Khuyến mãi phải là kiểu số.',
            'sale.between' => 'Khuyến mãi không nằm trong khoảng :min - :max.',
            'categories.required' => 'Danh mục là trường bắt buộc.',
            'supplier_id.required' => 'Nhà cung cấp là trường bắt buộc.',
            'product_images.required' => 'Ảnh chi tiết sản phẩm là trường bắt buộc.',
            'description.required' => 'Mô tả là trường bắt buộc.',
            'variants.required' => 'Biến thể là trường bắt buộc.',
            'variants.array' => 'Biến thể phải là mảng.',
            'variants.*.size.required' => 'Size là trường bắt buộc.',
            'variants.*.color_code.required' => 'Mã màu là trường bắt buộc.',
            'variants.*.color_name.string' => 'Tên màu không được chứa các ký tự đặc biệt.',
            'variants.*.color_name.max' => 'Tên màu không được phép quá 255 ký tự.',
            'variants.*.color_name.required' => 'Tên màu là trường bắt buộc.',
        ];
    }
}
