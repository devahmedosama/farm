<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFertilizationPlanLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fertilization_plan_locales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fertilization_plan_id')->nullable();
            $table->foreign('fertilization_plan_id')->references('id')
                        ->on('fertilization_plans')->onDelete('cascade');
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
        Schema::dropIfExists('fertilization_plan_locales');
    }
}
