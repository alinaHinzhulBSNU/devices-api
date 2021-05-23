<?php

namespace App\Models;

use App\Models\Model as ModelsModel;
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

    protected $visible = ['id', 'model', 'total_quantity', 'price', 'discount', 'ram', 'rom', 'color', 'image'];

    public function model(){
        return $this->belongsTo(
            ModelsModel::class,
            'model_id',
            'id'
        );
    }
}
