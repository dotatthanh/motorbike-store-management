<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionType extends Model
{
    use HasFactory;

    // public function optionValues()
    // {
    //     return $this->hasMany(OptionValue::class);
    // }

    // public function products()
    // {
    //     return $this->hasManyThrough(Product::class, OptionValue::class, 'option_type_id', 'id', 'id', 'product_id')
    //                 ->distinct();
    // }
}
