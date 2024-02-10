<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quotation;
use App\Models\Product;
class sub_quotation extends Model
{
    use HasFactory;
    protected $fillable = [
        'quotation_id', 'product_id','description','service_from','service_to','quantity','price'
    ];
    public function Quotation()
    {
        return $this->belongsTo(Quotation::class);
    }
    public function sub_quotation_product()
    {
        return $this->belongsTo(Product::class);
    }
}
