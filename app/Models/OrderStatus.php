<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderStatus extends Model
{
    use HasFactory;

    protected $table = 'order_status'; 
    protected $primaryKey = 'order_status_id'; 
    protected $fillable = ['status_name'];
    public function orders()
    {
        return $this->hasMany(Order::class, 'order_status_id', 'order_status_id');
    }

    public function getStatusNameAttribute()
    {
        return ucfirst($this->attributes['status_name']);
    }

}
