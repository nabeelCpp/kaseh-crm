<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrderScheduledDay extends Model
{
    use HasFactory;
    protected $fillable = ['day', 'sales_order_id', 'time'];

    public function salesorder() {
        return $this->belongsTo(SalesOrder::class);
    }
}
