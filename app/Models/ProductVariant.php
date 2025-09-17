<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ProductVariant extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'product_id',
        'variant_id',
        'quantity',
    ];

    public function variant()
    {
        return $this->belongsTo(Variant::class);
    }

    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}
