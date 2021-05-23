<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    use HasFactory;

    public $timestamps = false;
	
    protected $guarded = [];

    protected $visible = ['id', 'city_name', 'country', 'orders'];

    public function country(){
        return $this->belongsTo(
            Country::class,
            'country_id',
            'id'
        );
    }

    public function orders(){
        return $this->hasMany(
            Order::class,
            'city_id',
            'id'
        );
    }
}
