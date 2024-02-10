<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Caregiver;
use App\Models\Customer;
use App\Models\Product;
use App\Models\sub_quotation;

class Quotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'caregiver_id',
        'customer_id',
        'sales_person',
        'date',
        'refrence_description'
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
    public function sub_quotations()
    {
        return $this->hasMany(sub_quotation::class);
    }
}
