<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;

    // protected $table = 'products';
    protected $primaryKey = "product_id";
    protected $fillable = ['rice_type', 'selling_price'];
}
