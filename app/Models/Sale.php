<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;



class Sale extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'quantity_sold',
        'total_price',
        'customer_name',
        'location',
        'method',
        'sale_date',
        
    ];
    

    protected $primaryKey = 'sale_id';

    // Define the relationship with the Product model
    public function product()
    {
        return $this->belongsTo(Product::class, 'product_id');
    }

    // Optionally: If you want to explicitly enable automatic timestamping
    public $timestamps = true; 
}
