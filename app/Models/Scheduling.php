<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Scheduling extends Model
{
    use HasFactory;

    protected $fillable = [
        'start_date',
        'end_date',
        'caregiver_id',
        'sales_order_id',
        'scheduled_by'
    ];
}
