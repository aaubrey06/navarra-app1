<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Delivery extends Model
{
    use HasFactory;

    // Define the table name
    protected $table = 'delivery';

    // Specify the primary key
    protected $primaryKey = 'delivery_id';

    // Specify fillable attributes (columns you want to mass assign)
    protected $fillable = [
        'd_date',
        'driver_id',
        'vehicle_id',
        'order_id',
        'delivery_status_id',
        'delivery_address'
    ];

    // Define relationships

    /**
     * Get the order associated with the delivery.
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }

    /**
     * Get the driver associated with the delivery.
     */
    public function driver()
    {
        return $this->belongsTo(Driver::class, 'driver_id');
    }

    /**
     * Get the vehicle associated with the delivery.
     */
    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id');
    }

    /**
     * Get the delivery status associated with the delivery.
     */
    public function deliveryStatus()
    {
        return $this->belongsTo(DeliveryStatus::class, 'delivery_status_id');
    }
}
