<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class RegisterEquipment extends Model
{
    use HasFactory;

    public function equipment(){
        return $this->belongsTo(Equipment::class);
    }

    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function site(){
        return $this->belongsTo(warehouse::class,'warehouse_id','id');
    }
    public function location(){
        return $this->belongsTo(Vender::class,'vender_id','id');
    }
}
