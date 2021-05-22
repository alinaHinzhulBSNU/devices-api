<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Device extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = [
        'model_id',
        'total_quantity',
        'price',
        'discount',
        'ram',
        'rom',
        'color',
        'image'
    ];
}
