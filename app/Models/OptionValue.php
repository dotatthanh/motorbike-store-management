<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OptionValue extends Model
{
    use HasFactory;

    // public function products()
    // {
    //     return $this->belongsToMany(Product::class, 'product_option_values')
    //                 ->withPivot('quantity');
    // }

    // public function optionType()
    // {
    //     return $this->belongsTo(OptionType::class);
    // }
}
