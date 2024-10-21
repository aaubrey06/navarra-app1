<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Marker extends Model
{
    use HasFactory;

    // Assuming your markers table has columns: lat, lng, etc.
    protected $fillable = ['lat', 'lng'];
}
