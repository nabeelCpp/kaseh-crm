<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Invoice;
use App\Models\Quotation;
class Caregiver extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'nick_name',
        'nationality',
        'ic_number',
        'mobile',
        'profile',
        'passport',
        'passport_expiry_date',
        'visa',
        'visa_expiry_date',
        'date_of_birth',
        'age',
        'gender',
        'marital_status',
        'email',
        'profession',
        'trasportation',
        'status',
        'how_find_caregiver',
        'availability',
        'date_of_availability',
        'hashtag',
        'address_one',
        'address_two',
        'city',
        'country',
        'state',
        'postcode',
        'bank_name',
        'bank_account',
        'bank_cardholder',
        'xero_id',
        'internal_remarks',
        'skills',
        'height',
        'weight',
        'trainer'
    ];

    public function invoices_caregiver()
    {
        return $this->hasMany(Invoice::class);
    }
    public function quotations_caregivers()
    {
        return $this->hasMany(Invoice::class);
    }

    public function sales_orders() {
        return $this->hasMany(SalesOrder::class);
    }
}
