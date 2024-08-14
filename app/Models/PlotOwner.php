<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PlotOwner extends Model
{
    use HasFactory;

    protected $casts = [
        'documents'=>'json'
    ];
}
