<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('supplier_report_products', function (Blueprint $table) {
            $table->id();
            $table->foreignId('supplier_report_id')->constrained('supplier_reports')->cascadeOnDelete();
            $table->foreignId('company_id')->constrained('companies')->cascadeOnDelete();            
            $table->foreignId('product_services_id')->constrained('product_services')->cascadeOnDelete();
            $table->string('unit');
            $table->integer('quantity')->default(0);            
            $table->integer('price')->default(0);            
            $table->integer('discount')->default(0); 
            $table->integer('paid_amount')->default(0);
            $table->boolean('is_paid')->default(0);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('supplier_report_products');
    }
};
