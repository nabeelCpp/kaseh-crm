<?php

namespace App\Models;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ScheduledDay extends Model
{
    use HasFactory;
    protected $fillable = ['scheduling_id', 'sales_order_id', 'day', 'date', 'status'];

    public function schedule()  {
        return $this->belongsTo(Scheduling::class);
    }
}
