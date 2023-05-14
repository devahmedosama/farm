<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddStockItemIdToFertilizationPlanItemsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('fertilization_items', function (Blueprint $table) {
            $table->unsignedBigInteger('stock_item_id')->nullable();
            $table->foreign('stock_item_id')->references('id')
                            ->on('stock_items')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('fertilization_items', function (Blueprint $table) {
            //
        });
    }
}
