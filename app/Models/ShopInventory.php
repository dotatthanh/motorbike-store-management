<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class ShopInventory extends Model
{
    use HasFactory, SoftDeletes;

    public function motorcycle()
    {
        return $this->belongsTo(Motorcycle::class);
    }

    public function shop()
    {
        return $this->belongsTo(Shop::class);
    }

    public function purchaseOrderItems()
    {
        return $this->hasMany(PurchaseOrderItem::class, 'motorcycle_id', 'motorcycle_id');
    }

    public function salesOrderItems()
    {
        return $this->hasMany(SalesOrderItem::class, 'motorcycle_id', 'motorcycle_id');
    }
}
