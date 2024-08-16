<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Labour extends Model
{
    use HasFactory;

    public function group(){
        return $this->belongsTo(LabourGroup::class,'labour_group_id','id');
    }
}
