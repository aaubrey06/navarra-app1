<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryorder extends Model
{
    use HasFactory;

    protected $fillable = ['customer_name', 'location', 'delivery_schedule_id', 'driver_id'];

    public function schedule()
    {
        return $this->belongsTo(Deliveryschedule::class, 'delivery_schedule_id');
    }

    public function driver()
    {
        return $this->belongsTo(Driver::class);
    }
}
