<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Payslip extends Model
{
    use HasFactory;
    protected $fillable = ['caregiver_id', 'invoice_no', 'status', 'paid_at'];

    public function scheduling_days() {
        return $this->hasMany(ScheduledDay::class);
    }

    public function caregiver() {
        return $this->belongsTo(Caregiver::class);
    }
}
