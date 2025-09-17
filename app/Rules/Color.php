<?php

namespace App\Rules;

use Closure;
use Illuminate\Contracts\Validation\ValidationRule;

class Color implements ValidationRule
{
    /**
     * Run the validation rule.
     *
     * @param  \Closure(string): \Illuminate\Translation\PotentiallyTranslatedString  $fail
     */
    public function validate(string $attribute, mixed $value, Closure $fail): void
    {
        // Regex để kiểm tra các giá trị màu hex, rgb, rgba, và hsl
        if (! preg_match('/^#([a-fA-F0-9]{3}){1,2}$|'. // Hex (#fff hoặc #ffffff)
                        '^rgb\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*\)$|'. // RGB (rgb(255, 255, 255))
                        '^rgba\(\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(\d{1,3})\s*,\s*(0|1|0?\.\d+)\s*\)$|'. // RGBA (rgba(255, 255, 255, 0.5))
                        '^hsl\(\s*(\d{1,3})\s*,\s*(\d{1,3})%\s*,\s*(\d{1,3})%\s*\)$/', $value)) {
            // Nếu không khớp, gọi $fail để báo lỗi
            $fail('Mã màu phải là mã màu hợp lệ (hex, rgb, rgba, or hsl).');
        }
    }
}
