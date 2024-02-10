<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
use App\Models\Invoice;
use App\Models\Quotation;
class Customer extends Model
{
    use HasFactory;
    protected $fillable = [
        'first_name',
        'last_name',
        'age',
        'snn',
        'general_info_sex',
        'general_info_race',
        'general_info_ic',
        'general_info_nationality',
        'general_info_passport',
        'general_info_occupation',
        'general_info_website',
        'general_info_marital',
        'general_info_decease_date',
        'general_info_notes',
        'privateinfo_caregiver_responsibilities',
        'privateinfo_caregiver_requirements',
        'privateinfo_caregiver_notes',
        'privateinfo_caregiver_referrel_code',
        'contact_info_address',
        'contact_info_phone',
        'contact_info_city',
        'contact_info_state',
        'contact_info_zip',
        'contact_info_country',
        'contact_info_mobile',
        'contact_info_fax',
        'contact_info_email',
        'contact_info_latitude',
        'contact_info_longitude',
        'contact_info_dob',
        'emergencyfname',
        'emergency_phone',
        'emergency_lname',
        'emergency_mobile',
        'emergency_address',
        'emergency_fax',
        'emergency_email',
        'emergency_relation',
        'emergency_city',
        'emergency_state',
        'emergency_zip',
        'emergency_country',
        'emergency_geo_latitude',
        'emergency_longitude',
        'emergency_dob',
        'emergency_cf_fname',
        'emergency_cf_phone',
        'emergency_cf_lname',
        'emergency_cf_mobile',
        'emergency_cf_address',
        'emergency_cf_fax',
        'emergency_cf_email',
        'emergency_cf_relation',
        'emergency_cf_city',
        'emergency_cf_zip',
        'emergency_cf_state',
        'user_id',
        'emergency_cf_country',
        'emergency_cf_geo_latitude',
        'emergency_cf_longitude',
        'emergency_cf_dob',
        'care_medical_situation',
        'care_medical_history',
        'care_Surgical_History',
        'care_care_nature',
        'remember_token'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function invoices_customers()
    {
        return $this->hasMany(Invoice::class);
    }
    public function quotations_customers()
    {
        return $this->hasMany(Quotation::class);
    }

}
