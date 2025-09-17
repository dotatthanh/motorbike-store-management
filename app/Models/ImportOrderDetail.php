<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportOrderDetail extends Model
{
    use HasFactory;

    protected $fillable = [
        'import_order_id',
        'product_variant_id',
        'quantity',
        'price',
    ];

    public function importOrder()
    {
        return $this->belongsTo(ImportOrder::class);
    }

    public function productVariant()
    {
        return $this->belongsTo(ProductVariant::class);
    }
}
