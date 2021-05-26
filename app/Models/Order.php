<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    public $timestamps = false;
	
    protected $guarded = [];

    protected $visible = ['id', 'city', 'address', 'customer_name', 'date', 'phone', 'items'];

    public function city(){
        return $this->belongsTo(
            City::class,
            'city_id',
            'id'
        );
    }

    public function items(){
        return $this->hasMany(
            Item::class,
            'order_id',
            'id'
        );
    }
}
