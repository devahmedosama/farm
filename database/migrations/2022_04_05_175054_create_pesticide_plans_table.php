<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesticidePlansTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesticide_plans', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('nursery_id')->nullable();
            $table->foreign('nursery_id')->references('id')
                        ->on('nurseries')->onDelete('cascade');
            $table->unsignedBigInteger('farm_id')->nullable();
            $table->foreign('farm_id')->references('id')
                        ->on('farms')->onDelete('cascade');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')
                        ->on('users')->onDelete('cascade');
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
        Schema::dropIfExists('pesticide_plans');
    }
}
