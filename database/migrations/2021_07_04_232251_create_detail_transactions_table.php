<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateDetailTransactionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('detail_transactions', function (Blueprint $table) {
            $table->foreignUuid('transaction_id')->references('id')->on('header_transactions');
            $table->foreignUuid('beverage_id')->references('id')->on('beverages');
            $table->foreignId('topping_id')->references('id')->on('toppings');
            $table->foreignId('ice_id')->references('id')->on('ices');
            $table->foreignId('sugar_id')->references('id')->on('sugar');
            $table->primary(['transaction_id','beverage_id']);
            $table->integer('quantity');
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
        Schema::dropIfExists('detail_transactions');
    }
}
