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
        // Schema::create('blocks', function (Blueprint $table) {
        //     $table->id();
        //     $table->string('name');
        //     $table->
        //     $table->timestamps();
        // });

        Schema::create('plots', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('project_name');
            $table->string('block_name');
            $table->integer('khasra_no');
            $table->integer('phone_no');
            $table->integer('mauza_no');
            $table->text('address');
            $table->json('documents');
            $table->integer('amount');
            $table->integer('total_plots');
            $table->text('notes')->nullable();
            $table->json('plot_list');
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
        Schema::dropIfExists('plots');
    }
};
