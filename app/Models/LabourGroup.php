<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LabourGroup extends Model
{
    use HasFactory;

    public function labours(){
        return $this->hasMany(Labour::class);
    }
}
