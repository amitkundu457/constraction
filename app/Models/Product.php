<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    // protected $fillable = [
    //     'name',
    //     'price',
    //     'description',
    //     'image',
    //     'type',
    //     'created_by',
    // ];

    // public $customField;

    public function unit(){
        return $this->belongsTo(FoodUnit::class,'food_unit_id','id');
    }

    public function category(){
        return $this->belongsTo(FoodCategory::class,'food_category_id','id');
    }
    public function vender(){
        return $this->belongsTo(Vender::class,'vender_id','id');
    }
}
