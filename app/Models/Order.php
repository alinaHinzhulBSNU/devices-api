<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'city_id',
        'address',
        'customer_name',
        'date',
        'phone'
    ];
}
