<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStockTypeLocalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stock_type_locales', function (Blueprint $table) {
            $table->id();
            $table->char('name',255);
            $table->char('locale',255);
            $table->unsignedBigInteger('stock_type_id');
            $table->foreign('stock_type_id')->references('id')
                        ->on('stock_types')->onDelete('cascade');
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
        Schema::dropIfExists('stock_type_locales');
    }
}
