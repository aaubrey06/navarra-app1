<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Truck extends Model
{
    use HasFactory;


    protected $primaryKey = 'truck_id';

    public $incrementing = true;

    protected $keyType = 'int';

    protected $fillable = [
        'license_plate',
        'model',
        'year',
        'capacity',
        'color',
        'driver_id',
    ];

    public $timestamps = true;

    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }
}
