<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Shop extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'company_id',
        'name',
        'email',
        'phone_number',
        'address',
        'latitude',
        'longitude',
    ];

    public function company()
    {
        return $this->belongsTo(Company::class);
    }

    public function inventories()
    {
        return $this->hasMany(ShopInventory::class);
    }

    public function purchaseOrders()
    {
        return $this->hasMany(PurchaseOrders::class);
    }

    public function salesOrders()
    {
        return $this->hasMany(SalesOrders::class);
    }
}
