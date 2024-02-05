<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caregiver;
use App\Models\Customer;
use App\Models\Product;
class Invoice extends Model
{
    use HasFactory;
    protected $fillable = [
        'customer_id',
        'caregiver_id',
        'care_type',
        'product',
        'date_from',
        'date_to'
    ];
    public function caregiver()
    {
        return $this->belongsTo(Caregiver::class);
    }
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }
    public function products()
    {
        return $this->belongsTo(Product::class, 'product');
    }
}
