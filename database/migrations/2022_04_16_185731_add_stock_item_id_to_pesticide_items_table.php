<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockItemIdToPesticideItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('pesticide_items', function (Blueprint $table) {
            $table->unsignedBigInteger('stock_item_id')->nullable();
            $table->foreign('stock_item_id')->references('id')->on('stock_items')
                    ->onDelete('cascade');
            $table->unsignedBigInteger('fertilization_type_id')->nullable();
            $table->foreign('fertilization_type_id')->references('id')->on('fertilization_types')
                    ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('pesticide_items', function (Blueprint $table) {
            //
        });
    }
}
