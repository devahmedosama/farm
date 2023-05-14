<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUnitLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('unit_locales', function (Blueprint $table) {
            $table->id();
             $table->char('name',255);
            $table->char('locale',255);
            $table->unsignedBigInteger('unit_id');
            $table->foreign('unit_id')->references('id')
                        ->on('units')->onDelete('cascade');
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
        Schema::dropIfExists('unit_locales');
    }
}
