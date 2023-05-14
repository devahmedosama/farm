<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesticideItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesticide_items', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pesticide_plan_id')->nullable();
            $table->foreign('pesticide_plan_id')->references('id')
                        ->on('pesticide_plans')->onDelete('cascade');
            $table->unsignedBigInteger('stock_id');
            $table->foreign('stock_id')->references('id')
                        ->on('stocks')->onDelete('cascade');
            $table->date('date');
            $table->decimal('amount');
            $table->integer('state')->default(0)->nullable();
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
        Schema::dropIfExists('pesticide_items');
    }
}
