<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Product extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'name',
        'supplier_id',
        'file_path',
        'price',
        'sale',
        'description',
        'supplier_id',
    ];

    protected static function boot()
    {
        parent::boot();

        static::deleting(function ($product) {
            $product->productImages()->delete();
            CategoryProduct::where('product_id', $product->id)->delete();
            ProductVariant::where('product_id', $product->id)->delete();
        });
    }

    public function categories()
    {
        return $this->belongsToMany(Category::class, 'category_products', 'product_id', 'product_category_id');
    }

    public function productImages()
    {
        return $this->hasMany(ProductImage::class);
    }

    public function productVariants()
    {
        return $this->hasMany(ProductVariant::class);
    }

    public function variants()
    {
        return $this->belongsToMany(Variant::class, 'product_variants')
            ->withPivot('quantity');
    }

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }
}
