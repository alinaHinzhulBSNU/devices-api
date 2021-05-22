<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model as ParentModel;

class Model extends ParentModel
{
    use HasFactory;

    public $timestamps = false;
    
    protected $fillable = [
        'model_name',
        'brand_id',
        'description',
        'diagonal'
    ];
}
