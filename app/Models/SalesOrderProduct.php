<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'sales_order_id',
        'product_id',
        'qty',
        'unit_price',
        'total'
    ];

    public function salesOrder() {
        return $this->hasOne(SalesOrder::class);
    }

    public function product() {
        return $this->belongsTo(Product::class);
    }
}
