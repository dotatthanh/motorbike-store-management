<?php

namespace App\Models;

use App\Enums\OrderStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'customer_id',
        'total_money',
        'discount',
        'discount_code_id',
        'payment_method',
        'status',
    ];

    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    public function discountCode()
    {
        return $this->belongsTo(DiscountCode::class);
    }

    public function orderDetails()
    {
        return $this->hasMany(OrderDetail::class);
    }

    public function canBeCanceled()
    {
        if (in_array($this->status, OrderStatus::getCancelableStatuses())) {
            return true;
        }

        return false;
    }

    public function canBeUpdated()
    {
        if (in_array($this->status, OrderStatus::getUpdatableStatuses($this->status))) {
            return true;
        }

        return false;
    }
}
