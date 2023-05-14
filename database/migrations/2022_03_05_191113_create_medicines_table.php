<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateMedicinesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('medicines', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_id');
            $table->foreign('stock_id')->references('id')
                        ->on('stocks')->onDelete('cascade');
            $table->unsignedBigInteger('nursery_id')->nullable();
            $table->foreign('nursery_id')->references('id')
                        ->on('nurseries')->onDelete('cascade');
            $table->integer('quantity_per_100_letter')->nullable()->default(1);
            $table->decimal('amount')->default(1)->nullable();
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
        Schema::dropIfExists('medicines');
    }
}
