<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class WarehouseLocation extends Model
{
    use HasFactory;

    protected $primaryKey = 'warehouse_id';

    public $incrementing = true; 
    protected $keyType = 'int'; 

    protected $table = 'warehouse';

    protected $fillable = ['warehouse_location', 'warehouse_longitude', 'warehouse_latitude'];

    public $timestamps = false;
}
