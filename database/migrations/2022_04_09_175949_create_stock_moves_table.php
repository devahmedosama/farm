<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockMovesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_moves', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('stock_id');
            $table->foreign('stock_id')->references('id')
                        ->on('stocks')->onDelete('cascade');
            $table->unsignedBigInteger('nursery_id')->nullable();
            $table->foreign('nursery_id')->references('id')
                        ->on('nurseries')->onDelete('cascade');
            $table->unsignedBigInteger('farm_id')->nullable();
            $table->foreign('farm_id')->references('id')
                        ->on('farms')->onDelete('cascade');
            $table->unsignedBigInteger('equipment_id')->nullable();
            $table->foreign('equipment_id')->references('id')
                        ->on('equipments')->onDelete('cascade');
            $table->float('amount');
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
        Schema::dropIfExists('stock_moves');
    }
}
