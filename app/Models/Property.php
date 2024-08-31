<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Property extends Model
{
    use HasFactory;

    protected $casts = [
        'amenities'=>'json'
    ];

    public function contruct(){
        return $this->belongsTo(Contruct::class,'contract_type','id');
    }
}
