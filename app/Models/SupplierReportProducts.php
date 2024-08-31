<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SupplierReportProducts extends Model
{
    use HasFactory;

    public function company(){
        return $this->belongsTo(Company::class,'company_id','id');
    }

    public function productService(){
        return $this->belongsTo(ProductService::class,'product_services_id','id');
    }

    public function supplierReport(){
        return $this->belongsTo(SupplierReport::class,'supplier_report_id','id');
    }
}
