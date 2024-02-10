<?php
  
namespace App\Models;
  
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Quotation;
use App\Models\sub_quotation;
class Product extends Model
{
    use HasFactory;
  
    /**
     * The attributes that are mass assignable.
     *	
     * @var array
     */
    protected $fillable = [
        'name', 'detail','price'
    ];
    public function invoices_product()
    {
        return $this->hasMany(Product::class);
    }
    public function quotations_product()
    {
        return $this->hasMany(Quotation::class);
    }
    public function sub_quotations_prod()
    {
        return $this->hasMany(sub_quotation::class);
    }
}