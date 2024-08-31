<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierReport extends Model
{
    use HasFactory;

    public function vender(){
        return $this->belongsTo(Vender::class);
    }

    public function supplierReportProducts(){
        return $this->hasMany(SupplierReportProducts::class);
    }
}
