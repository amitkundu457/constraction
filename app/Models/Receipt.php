<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Receipt extends Model
{
    use HasFactory;

    protected $casts = [
        'materials'=>'json'
    ];

    public function project(){
        return $this->belongsTo(Project::class);
    }
    public function vender(){
        return $this->belongsTo(Vender::class);
    }
    public function company(){
        return $this->belongsTo(Company::class);
    }
}
