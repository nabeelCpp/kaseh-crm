<?php

namespace App\Models;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledDay extends Model
{
    use HasFactory;
    protected $fillable = ['scheduling_id', 'sales_order_id', 'day', 'date', 'status', 'reason_for_refuse', 'remarks', 'invoiced', 'reviewed_by'];

    public function scheduling()  {
        return $this->belongsTo(Scheduling::class);
    }

    public function user() {
        return $this->belongsTo(User::class, 'reviewed_by', 'id');
    }
}
