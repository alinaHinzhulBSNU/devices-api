<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Item extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'device_id',
        'order_id',
        'quantity',
        'total_sum'
    ];

    protected $visible = ['item_id', 'device', 'order', 'quantity', 'total_sum'];

    public function device(){
        return $this->belongsTo(
            Device::class,
            'device_id',
            'id'
        );
    }

    public function order(){
        return $this->belongsTo(
            Order::class,
            'order_id',
            'id'
        );
    }
}
