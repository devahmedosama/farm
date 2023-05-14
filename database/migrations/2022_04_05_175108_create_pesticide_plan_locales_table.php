<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePesticidePlanLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('pesticide_plan_locales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('pesticide_plan_id')->nullable();
            $table->foreign('pesticide_plan_id')->references('id')
                        ->on('pesticide_plans')->onDelete('cascade');
            $table->char('locale',255);
            $table->char('name',255);
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
        Schema::dropIfExists('pesticide_plan_locales');
    }
}
