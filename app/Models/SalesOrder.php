<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SalesOrder extends Model
{
    use HasFactory;
    protected $fillable = [
        'order_no',
        'user_id',
        'customer_id',
        'caregiver_id',
        'total_invoiced',
        'start_date',
        'end_date',
        'remarks',
        'stage',
        'status'
    ];


    protected static function boot()
    {
        parent::boot();

        static::created(function ($order) {
            // Generate the order_id using the current timestamp and pad it to 5 digits
            $orderId = str_pad($order->id, 5, '0', STR_PAD_LEFT);
            $order->order_no = $orderId;
            $order->save(); // Save the model with the generated order_id
        });
    }

    public function customer() {
        return $this->belongsTo(Customer::class);
    }

    public function caregiver() {
        return $this->belongsTo(Caregiver::class);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function products() {
        return $this->hasMany(SalesOrderProduct::class);
    }
}
