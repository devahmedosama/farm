<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateNurseryLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('nursery_locales', function (Blueprint $table) {
            $table->id();
            $table->char('name',255);
            $table->char('locale',255);
            $table->unsignedBigInteger('nursery_id');
            $table->foreign('nursery_id')->references('id')->on('nurseries')->onDelete('cascade');
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
        Schema::dropIfExists('nursery_locales');
    }
}
