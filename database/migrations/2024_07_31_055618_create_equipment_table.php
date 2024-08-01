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
        Schema::create('equipment', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->foreignId('equipment_type_id')->constrained('equipment_types')->cascadeOnDelete();
            $table->integer('quantity');
            $table->foreignId('equipment_manufacturer_id')->constrained('equipment_manufacturers')->cascadeOnDelete();
            $table->string('model_number')->nullable();
            $table->date('purchase_date')->nullable();
            $table->integer('purchase_price')->nullable();
            $table->text('description')->nullable();
            $table->boolean('status')->default(0);
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
        Schema::dropIfExists('equipment');
    }
};
