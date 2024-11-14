<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Customer extends Model
{
    use HasFactory;

    protected $table = 'customer';

    protected $primaryKey = 'customer_id';

    public $incrementing = true;


    protected $fillable = [
        'user_id',
        'phone',
        'region',
        'province',
        'city',
        'barangay',
        'address',
        'latitude',
        'longitude',
    ];


    // public function user()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }


    // public function orders()
    // {
    //     return $this->hasMany(Order::class, 'customer_id');
    // }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function orders()
    {
        return $this->hasMany(Order::class, 'customer_id');  // assuming 'customer_id' is the foreign key in the orders table
    }
}
