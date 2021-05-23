<?php

namespace App\Models;

use App\Models\Model as ModelsModel;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Brand extends Model
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'brand_name'
    ];

    public function models(){
        return $this->hasMany(
            ModelsModel::class,
            'brand_id',
            'id'
        );
    }
}
