<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class SalesOrderItem extends Model
{
    use HasFactory, SoftDeletes;

    public function salesOrder()
    {
        return $this->belongsTo(SalesOrder::class);
    }
}
