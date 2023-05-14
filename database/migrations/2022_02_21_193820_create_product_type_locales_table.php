<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProductTypeLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('product_type_locales', function (Blueprint $table) {
            $table->id();
            $table->char('name',255);
            $table->char('locale',255);
            $table->unsignedBigInteger('product_type_id');
            $table->foreign('product_type_id')->references('id')
                        ->on('product_types')->onDelete('cascade');
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
        Schema::dropIfExists('product_type_locales');
    }
}
