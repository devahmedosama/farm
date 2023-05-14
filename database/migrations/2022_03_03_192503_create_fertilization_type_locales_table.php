<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateFertilizationTypeLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('fertilization_type_locales', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('fertilization_type_id');
            $table->foreign('fertilization_type_id')->references('id')
                        ->on('fertilization_types')->onDelete('cascade');
            $table->char('name',255);
            $table->char('locale',255);
            $table->text('text')->nullable();
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
        Schema::dropIfExists('fertilization_type_locales');
    }
}
