<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as ParentModel;

class Model extends ParentModel
{
    use HasFactory;

    public $timestamps = false;
	
    protected $guarded = [];

    protected $visible = ['id', 'model_name', 'brand', 'description', 'diagonal', 'devices'];

    public function brand(){
        return $this->belongsTo(
            Brand::class,
            'brand_id',
            'id'
        );
    }

    public function devices(){
        return $this->hasMany(
            Device::class,
            'model_id',
            'id'
        );
    }
}
