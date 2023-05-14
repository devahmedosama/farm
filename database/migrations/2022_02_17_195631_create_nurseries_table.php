<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseriesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nurseries', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('plant_type_id');
            $table->foreign('plant_type_id')->references('id')->on('plant_types')->onDelete('cascade');
            $table->integer('no_seeds')->nullable()->default(0);
            $table->date('seeding_date');
            $table->date('transfering_seeds_to_plant_date');
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
        Schema::dropIfExists('nurseries');
    }
}
