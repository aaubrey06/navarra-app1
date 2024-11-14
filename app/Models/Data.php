<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Data extends Model
{
    use HasFactory;

    protected $fillable = [
        'sales_date',
        'rice_type',
        'unit',
        'quantity_sold',
    ];

    protected $table = 'data';
}