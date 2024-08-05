<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Retailer extends Model
{
    use HasFactory;

    public function category(){
        return $this->belongsTo(FoodCategory::class,'food_category_id','id');
    }

    public function area(){
        return $this->belongsTo(FoodArea::class,'food_area_id','id');
    }
}
