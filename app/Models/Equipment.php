<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Equipment extends Model
{
    use HasFactory;

    public function equipmentType(){
        return $this->belongsTo(EquipmentType::class);
    }
    
    public function equipmentManufacturer(){
        return $this->belongsTo(EquipmentManufacturer::class);
    }

    public function quality(){
        return $this->hasMany(QualityControl::class,'id','quality_control_id');
    }
}
