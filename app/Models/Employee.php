<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Employee extends Model
{
    use HasFactory;

    protected $table = 'employees';

    protected $primaryKey = 'employee_id';
    public $incrementing = true;

    protected $fillable = [
        'name',
        'gender',
        'position',
        'dob',
        'email',
        'phone_number',
        'address',
        'city',
        'province',
        'region',
        'postal_code',
        'nationality',
        'ssn',
    ];

    protected $casts = [
        'dob' => 'date',  
    ];
}
