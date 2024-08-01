<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EquipmentMaintainence extends Model
{
    use HasFactory;

    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }

    public function quality(){
        return $this->belongsTo(QualityControl::class,'quality_control_id','id');
    }

    public function agent(){
        return $this->belongsTo(Agent::class);
    }
}
