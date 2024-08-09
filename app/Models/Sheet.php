<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Sheet extends Model
{
    use HasFactory;

    protected $hidden = [
        'data'
    ];
    protected $casts = [
        'data'=>'json'
    ];

    public function share(){
        return $this->hasOne(SheetShare::class,'sheet_id','id');
    }
}
