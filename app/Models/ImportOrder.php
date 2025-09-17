<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ImportOrder extends Model
{
    use HasFactory;

    protected $fillable = [
        'code',
        'supplier_id',
        'user_id',
        'total_money',
    ];

    public function supplier()
    {
        return $this->belongsTo(Supplier::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function importOrderDetails()
    {
        return $this->hasMany(ImportOrderDetail::class);
    }
}
