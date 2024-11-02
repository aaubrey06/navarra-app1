<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Deliveryschedule extends Model
{
    use HasFactory;

    protected $fillable = ['delivery_time'];

    public function Deliveryorders()
    {
        return $this->hasMany(Deliveryorder::class);
    }
}
